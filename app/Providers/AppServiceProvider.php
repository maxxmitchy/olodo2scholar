<?php

namespace App\Providers;

use Livewire\Component;
use Illuminate\Support\Str;
use App\ModelKey\KeyFactory;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
            macro: fn (string $prefix, int | null $length = null) => KeyFactory::generate(
                prefix: $prefix,
                length: $length,
            ),
        );

        Component::macro('notify', function ($message) {
            $this->dispatchBrowserEvent('notify', $message);
        });

        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });
    }
}
