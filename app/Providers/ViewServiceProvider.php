<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Menu;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Menyuntikkan data menu ke semua view yang menggunakan footer
        View::composer('footer', function ($view) {
            $menu = Menu::all();
            $view->with('menu', $menu);
        });
    }

    public function register()
    {
        //
    }
}
