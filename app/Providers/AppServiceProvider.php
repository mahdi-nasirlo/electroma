<?php

namespace App\Providers;

use App\Models\Infographic;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;

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

            Filament::registerStyles([
                Vite::asset('resources/css/font.css')
            ]);
            // if (config('app.env') !== 'build') {
            //     Filament::registerViteTheme('resources/css/filament.css');
            // }
        });

        $this->app->bind(LoginResponseContract::class, \App\Http\Responses\LoginResponse::class);

        if (config('app.env') !== 'build') {
            if (Schema::hasTable("infographics")) {
                $data = Infographic::all(['name', 'content'])
                    // ->whereIn("name", ['location'])
                    ->keyBy("name")
                    ->toArray();

                view()->composer('*', function ($view) use ($data) {
                    $view->with('information', $data);
                });
            }
        }
    }
}
