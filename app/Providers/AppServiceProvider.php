<?php

namespace App\Providers;

use App\Models\Genre;
use App\Models\Setting;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Builder;
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
        Builder::macro('search', function (string $attribute, string $search) {
            return $search ? $this->where($attribute, 'LIKE', "%{$search}%") : $this;
        });
        Builder::macro('siteSearch', function (string $attribute, string $search) {
            return $search ? $this->where($attribute, 'LIKE', "%{$search}%") : $this;
        });
        view()->composer('layouts.front', function($view) {
            $view->with(['genres' => Genre::all()->sortBy('name')]);
        });
        view()->composer('layouts.front', function($view) {
            $view->with(['settings' => Setting::find(1)]);
        });

    }
}
