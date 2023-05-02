<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Notification;
use App\Models\User;

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
        view()->composer(['partials.header', 'partials.footer'], function ($view) {
            $notifications = Notification::orderBy('isRead', 'ASC')->get();
            $not_read = Notification::where('isRead', '0')->get();
            $user = User::where('id', auth()->user()->id)->first();
            $view->with([
                'notifications' => $notifications,
                'not_read' => $not_read,
                'user' => $user
            ]);
        });

        Paginator::useBootstrap();
    }
}
