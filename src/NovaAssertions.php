<?php

declare(strict_types=1);

namespace ArthurTavaresDev\PestPluginNova;

use ArthurTavaresDev\PestPluginNova\Assertions\AssertActions;
use ArthurTavaresDev\PestPluginNova\Assertions\AssertCards;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Testing\TestResponse;
use function Pest\Laravel\get;

trait NovaAssertions
{
    use AssertActions;
    use AssertCards;

    public string|int|null $resourceId = null;
    public string|null $endpoint;
    public Model $resource;
    public TestResponse $novaResponse;

    public function novaIndex(Model|string $resource, array|Collection $filters = []): TestResponse
    {
        $resourceName = $this->getResourceName($resource);

        $filters        = $this->makeNovaFilters($filters);
        $this->resource = $this->resolveUriKey($resourceName);
        $this->endpoint = "nova-api/{$resourceName}?{$filters}";

        return $this->setNovaResponse();
    }

    private function getResourceName(Model|string $resource): string
    {
        return is_object($resource) ? get_class($resource) : $resource;
    }

    protected function makeNovaFilters(array|Collection $filters): string
    {
        if (blank($filters)) {
            return '';
        }

        $encoded = collect($filters)->map(function ($value, $key) {
            return ['class' => $key, 'value' => $value];
        })->values()->toJson();

        return "filters=$encoded";
    }

    public function resolveUriKey(string $class): string
    {
        if (class_exists($class)) {
            return app($class)->uriKey();
        }

        return $class;
    }

    public function setNovaResponse(string $path = ''): TestResponse
    {
        $build = ['path' => $path];

        if (filled($this->resourceId)) {
            $build['query'] = ['resourceId' => $this->resourceId];
        }

        $this->endpoint = http_build_url($this->endpoint, $build);

        abort_if(filled($this->endpoint) && str_contains($this->endpoint, 'creation-fields'), 500, "No $path on forms");
        abort_if(filled($this->endpoint) && str_contains($this->endpoint, 'update-fields'), 500, "No $path on forms");

        return $this->novaResponse = get($this->endpoint);
    }
}
