# Laravel guzzle

A Laravel facade for GuzzleHttp Client.

## Installing

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require sanchescom/laravel-guzzle
```

### Laravel 5.x:

After updating composer, add the ServiceProvider to the providers array in `config/app.php`

 ```php
'providers' => [
    ...
    Sanchescom\Guzzle\Providers\GuzzleServiceProvider::class,
],
```

### Lumen:

After updating composer add the following lines to register provider in `bootstrap/app.php`

```php
$app->register(Sanchescom\Guzzle\Providers\GuzzleServiceProvider::class);
```

## Usage

#### GET Status code
```php
<?php

use Sanchescom\Guzzle\Facades\Guzzle;

/**
 * $statusCode = int(200)
 */
$statusCode = Guzzle::get('https://some.thing')->getStatusCode();
```

#### POST with custom config
```php
<?php

use Sanchescom\Guzzle\Facades\Guzzle;

$config = [
    "base_uri" => "https://some.thing.new",
];

$data = [
    "email" => "some@thing.new",  
];

/**
 * $statusCode = int(201)
 */
$statusCode = Guzzle::config($config)->post('users', $data)->getStatusCode();
```