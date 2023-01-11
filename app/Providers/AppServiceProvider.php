<?php

namespace App\Providers;

use App\ModelKey\KeyFactory;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Str::macro(
            name: 'key',
            macro: fn (string $prefix, int|null $length = null) => KeyFactory::generate(
                prefix: $prefix,
                length: $length,
            ),
        );

        // Blade::if('admin', function () {
        //     return auth()->check() && auth()->user()->isAdmin();
        // });
    }
}
