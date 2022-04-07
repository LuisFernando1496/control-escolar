<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

use App\View\Components\Actions\ConfirmDeletion;
use App\View\Components\TableIndex;

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
         Blade::component('confirm-deletion', ConfirmDeletion::class);
         Blade::component('table-index',TableIndex::class);
    }
}