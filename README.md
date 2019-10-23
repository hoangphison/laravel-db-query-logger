# Database Query Logger for Laravel 5

## Basic installation
```
composer require sonhp/laravel-db-query-logger --dev
```

## Config

### Laravel 5.2 ~ 5.4
If you use Laravel version lower than 5.5, you'll need to register the service provider:
```
// config/app.php

'providers' => [
    // ...
    SonHP\LaravelDbQueryLogger\Providers\ServiceProvider::class,
],
```
