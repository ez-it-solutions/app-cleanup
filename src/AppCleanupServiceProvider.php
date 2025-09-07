<?php
/**
 * File: AppCleanupServiceProvider.php
 * 
 * Purpose: Service provider for the AppCleanup package.
 * Registers the app:cleanup command with Laravel.
 * 
 * @package     Ez_IT_Solutions\AppCleanup
 * @author      Ez IT Solutions Development Team
 * @version     1.0.0
 * @since       2025-09-07
 */

namespace Ez_IT_Solutions\AppCleanup;

use Illuminate\Support\ServiceProvider;
use Ez_IT_Solutions\AppCleanup\Commands\AppCleanup;

class AppCleanupServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AppCleanup::class,
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // No additional services to register
    }
}
