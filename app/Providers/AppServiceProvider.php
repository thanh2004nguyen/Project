<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Chat;
use App\Models\Provider;
use App\Models\User;
use App\Models\product;
use App\Models\Blog;

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

    //    $chatAll = Chat::withCount('unseen_messages')->orderBy('unseen_messages_count', 'desc')->get();
    //     foreach ($chatAll as $chat) {
    //         $check = User::where('email', $chat->email)->first();
    //         if ($check == null) {
    //             $chat['owner'] = null;
    //         } else {
    //             $chat['owner'] = $check;
    //         }
    //     }


    //     View::share('chatAll', $chatAll);
}
}
