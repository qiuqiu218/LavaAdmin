<?php

namespace App\Providers;

use App\Models\Admin\Menu;
use App\Models\Admin\Permission;
use App\Models\Table;
use App\Observers\Admin\MenuObserver;
use App\Observers\Admin\PermissionObserver;
use App\Observers\TableObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Menu::observe(MenuObserver::class);
        Table::observe(TableObserver::class);
        Permission::observe(PermissionObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
