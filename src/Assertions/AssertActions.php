<?php

declare(strict_types=1);

namespace ArthurTavaresDev\PestPluginNova\Assertions;

use function app;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Testing\Assert as PHPUnit;
use Illuminate\Testing\TestResponse;
use JsonException;

trait AssertActions
{

    public function assertActionCount($amount): self
    {
        $this->setNovaResponse('actions');

        $this->novaResponse->assertJsonCount($amount, 'actions');

        return $this;
    }

    /**
     * @throws JsonException
     */
    public function assertActions(Closure $callable): self
    {
        $original = $this->novaResponse->original;

        $actions = Arr::get($original, 'actions', [])->all();

        PHPUnit::assertTrue($callable($actions));

        return $this;
    }

    public function assertActionsInclude(string|object $class): self
    {
        $this->setNovaResponse('actions');

        $this->novaResponse->assertJsonFragment([
            'uriKey' => app($class)->uriKey(),
        ]);

        return $this;
    }

    public function assertActionsExclude($class): self
    {
        $this->setNovaResponse('actions');

        $this->novaResponse->assertJsonMissing([
            'uriKey' => app($class)->uriKey(),
        ]);

        return $this;
    }
}
