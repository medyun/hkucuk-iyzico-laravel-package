## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/downloads.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

This package offers simply iyzico laravel bundled payment system API for PHP Framework.

## Installation

The hkucuk/iyzico Service Provider can be installed via [Composer](http://getcomposer.org) by requiring the
`hkucuk/iyzico` package in your project's `composer.json`.

```json
{
    "require": {
        "hkucuk/iyzico": "v1.0.0"
    }
}
```

After need update composer
```
composer update
```

To use the hkucuk/iyzico Service Provider, you must register the provider when bootstrapping your Laravel application.

Find the `providers` key in your `config/app.php` and register the hkucuk/iyzico Service Provider.

```php
    'providers' => array(
        // ...
        'Hkucuk\Iyzico\IyzicoServiceProvider',
    )
```

Find the `aliases` key in your `config/app.php` and add the AWS facade alias.

```php
    'aliases' => array(
        // ...
        'Iyzico'		  => 'Hkucuk\Iyzico\Facades\Iyzico',
    )
```

## Configuration

By default, the package uses the following environment variables to auto-configure the plugin without modification:
```
api_id
secret
```

To customize the configuration file, publish the package configuration using Artisan.

```sh
php artisan vendor:publish
```

Update your settings in the generated `app/config/packages/hkucuk/iyzico/config.php` configuration file.

```php
return array(

    'api_id' => 'iyzico-api-id',

    'secret' => 'iyzico-secret'

);
```

## Usage

İyzico working principle is two request, two response. We want the first payment forms iyzico like this:

```php
  $data = array(
		"customer_language" => "tr",
		"mode" => "test",
		"external_id" => rand(),
		"type" => "CC.DB",
		"installment" => true,
		"amount" => 1099,
		"return_url" => "http://example.com/iyzicoResponse",
		"currency" => "TRY"
	);

	$response = Iyzico::getForm($data);

	echo $response->code_snippet;
```

code_snippet will return to us with means of payment form iyzico.

After payment form approved will send the results to return iyzico mentioned URLs.

```php
  $data = json_decode(Input::get("json"), true);
  var_dump($data);
```
