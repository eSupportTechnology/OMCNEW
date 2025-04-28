<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\NotificationController;

class NotificationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Sharing notifications with all views in the admin_dashboard folder
        view()->composer('admin_dashboard.*', function ($view) {
            $notificationController = new NotificationController();
            $notifications = $notificationController->getNotifications();
            $view->with('notifications', $notifications);
        });
    }

    public function register()
    {
        //
    }
}
