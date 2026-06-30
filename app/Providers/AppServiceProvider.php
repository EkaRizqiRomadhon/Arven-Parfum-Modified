<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ContactMessage;

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
        // View composer untuk admin layout agar tidak ada query database langsung di file Blade
        View::composer('layouts.admin', function ($view) {
            $unreadCount = ContactMessage::where('status', 'unread')->count();
            $view->with('adminUnreadMessagesCount', $unreadCount);
        });
    }
}
