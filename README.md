# Laravel Datagrid Builder

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Code Coverage][ico-coveralls]][link-coveralls]
[![Total Downloads][ico-downloads]][link-downloads]

This package gives you access effortlessly to data from every country.

## Install

Via Composer

``` bash
composer require lykegenes/laravel-countries
```

Then, add this to your Service Providers :

``` php
Lykegenes\LaravelCountries\ServiceProvider::class,
```

...and this to your Aliases :

``` php
'Countries' => Lykegenes\LaravelCountries\Facades\Countries::class,
```

Optionally, you can publish and edit the configuration file :

``` bash
php artisan vendor:publish --provider="Lykegenes\LaravelCountries\ServiceProvider" --tag=config
```

## Usage

Coming soon!

## Credits

- [Patrick Samson][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/lykegenes/laravel-countries.svg
[ico-license]: https://img.shields.io/packagist/l/lykegenes/laravel-countries.svg
[ico-travis]: https://img.shields.io/travis/Lykegenes/laravel-countries/master.svg
[ico-coveralls]: https://img.shields.io/coveralls/Lykegenes/laravel-countries.svg
[ico-downloads]: https://img.shields.io/packagist/dt/lykegenes/laravel-countries.svg

[link-packagist]: https://packagist.org/packages/lykegenes/laravel-countries
[link-travis]: https://travis-ci.org/Lykegenes/laravel-countries
[link-coveralls]: https://coveralls.io/github/Lykegenes/laravel-countries
[link-downloads]: https://packagist.org/packages/lykegenes/laravel-countries
[link-author]: https://github.com/lykegenes
[link-contributors]: ../../contributors
