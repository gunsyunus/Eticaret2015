<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Title information for the forgot password email template.
        view()->composer('emails.customerPassword', function ($view) {
            $settings = Setting::select('title')->find(1);
            $view->with([
                'title' => $settings->title,
            ]);
        });
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
