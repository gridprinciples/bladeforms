# CSS-agnostic form rendering via Laravel Blade

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gridprinciples/blade-forms.svg?style=flat-square)](https://packagist.org/packages/gridprinciples/blade-forms)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/gridprinciples/blade-forms/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/gridprinciples/blade-forms/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/gridprinciples/blade-forms/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/gridprinciples/blade-forms/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/gridprinciples/blade-forms.svg?style=flat-square)](https://packagist.org/packages/gridprinciples/blade-forms)

A set of Blade components useful for rendering basic, fully-accessible HTML forms.  CSS and JS is not included, but Tailwind (and possibly other framework) presets are planned.

## Installation

You can install the package via composer:

```bash
composer require gridprinciples/blade-forms
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="blade-forms-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="blade-forms-views"
```

## Usage

```blade
<x-form :post="route('form-submission-route')">
    <x-form::input 
        name="first_name" 
        label="Your first name" 
        help="The one you were born with"
        required
        />
    <x-form::radio-buttons 
        name="weekday"
        label="Preferred weekday" 
        :options="[
            'mo' => 'Monday',
            'tu' => 'Tuesday',
            'we' => 'Wednesday',
            'th' => 'Thursday',
            'fr' => 'Friday',
        ]"
        required
        />
    <x-form::checkbox
        name="agree"
        label="Do you agree?"
        />
</x-form>
```

Result:

[image]

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Greg Brock](https://github.com/gridprinciples)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
