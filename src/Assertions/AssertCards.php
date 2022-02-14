<?php

declare(strict_types=1);

namespace ArthurTavaresDev\PestPluginNova\Assertions;

use Closure;
use Illuminate\Testing\Assert as PHPUnit;
use JsonException;
use Laravel\Nova\Card;

trait AssertCards
{
    public function assertCardCount($count): self
    {
        $this->setNovaResponse('cards');
        $this->novaResponse->assertJsonCount($count);

        return $this;
    }

    /**
     * @throws JsonException
     */
    public function assertCards(Closure $callable): self
    {
        $original = $this->novaResponse->original;
        $cards    = collect(json_decode(json_encode($original, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR));
        PHPUnit::assertTrue($callable($cards));

        return $this;
    }

    public function assertCardsInclude($class): self
    {
        $this->setNovaResponse('cards');
        $this->novaResponse->assertJsonFragment([
            'component' => $this->extractComponentName($class),
        ]);

        return $this;
    }

    public function assertCardsExclude($class): self
    {
        $this->setNovaResponse('cards');
        $this->novaResponse->assertJsonMissing([
            'component' => $this->extractComponentName($class),
        ]);

        return $this;
    }

    protected function extractComponentName(string|Card $class): string|Card
    {
        if (is_object($class)) {
            return $class->component();
        }

        return class_exists($class) ? app($class)->component() : $class;
    }
}
