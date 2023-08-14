<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
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
        Paginator::useBootstrapFour();
        Schema::defaultStringLength(191);
        if (Schema::hasTable('settings')) {
            $groubs = \App\Models\Setting::groupBy('group')->pluck('group');

            $settings = \App\Models\Setting::whereIn('group', $groubs)->get();

            $all = [];

            foreach ($groubs as $groub) {

                $settings = \App\Models\Setting::where('group', $groub)->get();
                $data = [];
                foreach ($settings as $setting) {
                    $data[$setting->key] = $setting->value;
                }
                $all[$groub] = $data;
            }

            Config::set(['settings' => $all]);

           
        }
    }
}
