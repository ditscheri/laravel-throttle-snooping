# laravel-throttle-snooping

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ditscheri/laravel-throttle-snooping.svg?style=flat-square)](https://packagist.org/packages/ditscheri/laravel-throttle-snooping)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ditscheri/laravel-throttle-snooping/run-tests?label=tests)](https://github.com/ditscheri/laravel-throttle-snooping/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/ditscheri/laravel-throttle-snooping/Check%20&%20fix%20styling?label=code%20style)](https://github.com/ditscheri/laravel-throttle-snooping/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/ditscheri/laravel-throttle-snooping.svg?style=flat-square)](https://packagist.org/packages/ditscheri/laravel-throttle-snooping)

This package aims to detect suspicious IP addresses and/or users that cause too many `401`/`403` response status codes.

It does this by appending a middleware to your kernel, which uses a `RateLimiter`.

## Installation

You can install the package via composer:

```bash
composer require ditscheri/laravel-throttle-snooping
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Ditscheri\ThrottleSnooping\ThrottleSnoopingServiceProvider" --tag="throttle-snooping-config"
```
## Usage

```php
// TODO
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

If you discover any security related issues, please email daniel@ditscheri.com instead of using the issue tracker.

## Credits

- [Daniel Bakan](https://github.com/ditscheri)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
