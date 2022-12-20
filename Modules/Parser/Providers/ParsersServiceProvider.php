<?php

namespace Modules\Parser\Providers;

use Illuminate\Support\ServiceProvider;

class ParsersServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('Parser', 'Modules\Parser\Services\ParserService');

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [];
    }
}
