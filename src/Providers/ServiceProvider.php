<?php

namespace SonHP\LaravelDbQueryLogger\Providers;

use Illuminate\Events\Dispatcher;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot(Dispatcher $event)
    {
        if (env('LOG_DB_QUERY')) {
            $event->listen(QueryExecuted::class, function (QueryExecuted $event) {
                $sql = str_replace(['%', '?'], ['%%', '%s'], $event->sql);

                $bindings = $event->connection->prepareBindings($event->bindings);

                $pdo = $event->connection->getPdo();

                $this->app->make('log')->debug(
                    vsprintf($sql, array_map([$pdo, 'quote'], $bindings))
                );
            });
        }
    }

    public function register()
    {
        //
    }
}
