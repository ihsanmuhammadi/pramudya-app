<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Goods;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // parent::boot();

    // Fix UUID model binding
    \Route::bind('goods', function ($value) {
        return Goods::where('id', $value)->firstOrFail();
    });
    }
}
