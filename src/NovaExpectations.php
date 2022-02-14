<?php
//
//declare(strict_types=1);
//
//use Illuminate\Auth\Authenticatable;
//use Illuminate\Http\Response;
//use Illuminate\Support\Collection;
//use Illuminate\Testing\TestResponse;
//use NovaTesting\NovaResponse;
//use Pest\Expectation;
//use function Pest\Laravel\assertAuthenticated;
//use function PHPUnit\Framework\assertEquals;
//
////function getNovaResponse(Expectation $expectation): NovaResponse
////{
////    /** @var TestResponse|NovaResponse|Response $response */
////    $response = $expectation->value;
////
////    if ($response instanceof NovaResponse) {
////        return $response;
////    }
////
////    // @phpstan-ignore-next-line
////    return NovaResponse::fromTestResponse($response);
////}
////
////expect()->extend(
////    'toBeNovaAuthenticated',
////    /**
////     * Assert that the given User is authenticated.
////     */
////    function (): Expectation {
////        assertAuthenticated();
////
////        /** @var Authenticatable $authenticated */
////        // @phpstan-ignore-next-line
////        $authenticated = \Illuminate\Support\Facades\Auth::guard(config('nova.guard', 'web'))->user();
////
////        // @phpstan-ignore-next-line
////        assertEquals($this->value->id, $authenticated->id, "The User ID #{$this->value->id} doesn't match authenticated User ID #{$authenticated->id}");
////
////        return $this;
////    }
////);
////
////expect()->extend(
////    'toBeCardsCount',
////    /**
////     * Assert that the response has a successful status code.
////     */
////    extend: function (int $amount): Expectation {
////        $response = getNovaResponse($this);
////        $response->assertCardCount($amount);
////
////        return $this;
////    }
////);
////
////expect()->extend(
////    'toBeCardInclude',
////    /**
////     * Assert that the response has a successful status code.
////     */
////    function (string|Laravel\Nova\Card $card): Expectation {
////        $response = getNovaResponse($this);
////        $response->assertCardsInclude($card);
////
////        return $this;
////    }
////);
////
////expect()->extend(
////    'toBeField',
////    /**
////     * Assert that the response has a successful status code.
////     */
////    function (Collection|string|array $attribute, mixed $value = null): Expectation {
////        $response = getNovaResponse($this);
////        $response->assertFieldsInclude($attribute, $value);
////
////        return $this;
////    }
////);
