<?php

namespace Radevlabs\Bake;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Radevlabs\Bake\Commands\InstallBake;
use Radevlabs\Bake\Commands\MakeBrowse;
use Radevlabs\Bake\Components\Fields\Field;
use Radevlabs\Bake\Components\Fields\File;
use Radevlabs\Bake\Components\Fields\Text;

class BakeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        require_once(__DIR__ . '/helper.php');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallBake::class,
                MakeBrowse::class
            ]);
        }

        $this->publishes([
            __DIR__.'/../publishable/assets' => public_path('vendor/bake/assets')
        ], 'asset');
        $this->publishes([
            __DIR__.'/../publishable/migrations' => database_path('migrations'),
            __DIR__.'/../publishable/seeds' => database_path('seeds')
        ], 'database');
        $this->publishes([
            __DIR__.'/../publishable/components' => app_path('Http/Livewire')
        ], 'component');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'bake');

        Livewire::component('field', Field::class);
        Livewire::component('file', File::class);
    }
}
