<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\URL;
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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Filament::serving(function () {

            Filament::registerNavigationGroups([
                'سطوح دسترسی',
                'فروشگاه',
                'بلاگ',
                'خدمات'
            ]);

            Filament::registerViteTheme('resources/css/vendor/filament.css');
        });

        // if (Schema::hasTable("infographics")) {
        //     $data = Infographic::all(['name', 'content'])
        //         // ->whereIn("name", ['location'])
        //         ->keyBy("name")
        //         ->toArray();

        //     view()->composer('*', function ($view) use ($data) {
        //         $view->with('information', $data);
        //     });
        // }
    }
}
