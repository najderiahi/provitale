<?php

namespace App\Providers;

use App\Category;
use App\Paginator\CustomLengthAwarePaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\View;
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
        $this->app->bind(LengthAwarePaginator::class, CustomLengthAwarePaginator::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layouts.guest'], function ($view) {
            $view->with('categories', Category::all());
        });
    }
}
