<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\ProductComment;
use App\Models\Table;
use App\Observers\Admin\MenuObserver;
use App\Observers\Admin\PermissionObserver;
use App\Observers\Admin\ProductCommentObserver;
use App\Observers\Admin\TableObserver;
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
        ProductComment::observe(ProductCommentObserver::class);
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
