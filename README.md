# Laravel Nova (Pest Plugin)

[![Author][ico-author]][link-author]
[![PHP Version][ico-php]][link-php]
[![Laravel Version][ico-laravel]][link-laravel]
[![Laravel Nova][ico-nova]][link-nova]

## Install

Via Composer

``` bash
composer require --dev arthurtavaresdev/pest-plugin-nova
```

## Usage

Once the plugin is installed you are ready to go! Combine the elegant syntax of [Pest](https://pestphp.com/docs/writing-tests) and [Nova Assertions](https://github.com/dillingham/nova-assertions#usage):

### Assertions
For more details about assertions you can check the [original package](https://github.com/dillingham/nova-assertions#usage).

```php
beforeEach(function () {
    Order::factory()->count(10)->create();
    $this->be(User::factory()->create());
});

test('index orders')
    ->novaIndex('orders')
    ->assertOk()
    // assert resources
    ->assertResources(fn($resources) => $resources->count() === 10)
    // assert cards
    ->assertCardCount(3)
    ->assertCardsInclude(OrderAmountPerDay::class)
    ->assertCardsInclude(OrderPerMerchant::class)
    ->assertCardsInclude(OrderPerStatus::class)
    // assert actions
    ->assertActionCount(1)
    ->assertActionsInclude(CancelOrderAction::class)
    // assert filters
    ->assertFilterCount(2)
    ->assertFiltersInclude(OrderStatusFilter::class)
    ->assertFiltersInclude(MerchantFilter::class)
    // assert fields
    ->assertFieldsInclude(['id', 'status', 'amount', 'created_at'])
    ->assertFieldsExclude(['external_id', 'currency'])
    // assert policies
    ->assertCanView()
    ->assertCanCreate()
    ->assertCanUpdate()
    ->assertCanDelete()
    ->assertCannotForceDelete()
    ->assertCannotRestore();
    ...
```

### Expectations

[WIP]
```php
    test('can index orders', function () {
       expect($this->novaIndex('orders')
           ->toBeCardsCount(3)
           ->toBeCardInclude(OrderAmountPerDay::class)
   });

    test('can update order', function () {
       expect($this->novaEdit('orders', Order::factory()->create()->id))
           ->toBeField('merchant')
           ->toBeField('shopper')
           ->toBeField('amount')
           ->toBeField('created_at')
           ->toBeField('tags');
   });
});

```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
composer test
```

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security
If you discover any security related issues, please email arthurabreu00@gmail.com instead of using the issue tracker.

## Credits

- [Arthur Tavares][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-author]: https://img.shields.io/static/v1?label=author&message=arthurabreu00&color=50ABF1&logo=twitter&style=flat-square
[ico-php]: https://img.shields.io/packagist/php-v/arthurtavaresdev/pest-plugin-nova?color=%234F5B93&logo=php&style=flat-square
[ico-laravel]: https://img.shields.io/static/v1?label=laravel&message=%E2%89%A58.0&color=ff2d20&logo=laravel&style=flat-square
[ico-nova]: https://img.shields.io/static/v1?label=Nova&message=%E2%89%A53.0&color=4099de&logo=laravel-nova&style=flat-square
[ico-version]: https://img.shields.io/packagist/v/arthurtavaresdev/pest-plugin-nova.svg?label=version&style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-psr12]: https://img.shields.io/static/v1?label=compliance&message=PSR-12&color=blue&style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/arthurtavaresdev/pest-plugin-nova.svg?style=flat-square

[link-author]: https://twitter.com/arthurabreu00
[link-php]: https://www.php.net
[link-laravel]: https://laravel.com
[link-nova]: https://nova.laravel.com/
[link-packagist]: https://packagist.org/packages/arthurtavaresdev/pest-plugin-nova
[link-actions]: https://github.com/arthurtavaresdev/pest-plugin-nova/actions?query=workflow%3Abuild
[link-psr12]: https://www.php-fig.org/psr/psr-12/
[link-downloads]: https://packagist.org/packages/arthurtavaresdev/pest-plugin-nova
[link-contributors]: ../../contributors
