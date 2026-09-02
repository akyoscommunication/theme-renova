<?php

namespace App\Providers;

use Akyos\Core\AkyosBootLoader;
use Roots\Acorn\Sage\SageServiceProvider;

class AkyosServiceProvider extends SageServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        parent::register();
    
        $this->app->singleton('akyos', function () {
            return new AkyosBootLoader();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
        try {
            $this->app->make('akyos')->load();
        } catch (\Throwable $e) {
            if(WP_ENV === 'development') {
               wp_die("An error occured while booting AkyosCore: " . $e->getMessage());
            }
        }    
    }
}
