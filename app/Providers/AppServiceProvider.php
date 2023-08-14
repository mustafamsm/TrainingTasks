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
            $alldata = [
                'general' => [
                    'site_name' => 'Laravel Blog',
                    'site_description' => 'Laravel Blog',
                    'site_status' => 'active',
                    'site_message' => 'Welcome to my blog',
                    'site_footer' => 'Laravel Blog',
                    'site_logo' => 'logo.png',
                    'site_icon' => 'favicon.png',
                    'site_address' => 'Dhaka,Bangladesh',

                ]
            ];
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

            dd(Config::get('settings'));
        }
    }
}
