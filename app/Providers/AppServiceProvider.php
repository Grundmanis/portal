<?php

namespace App\Providers;

use App\Advert;
use Illuminate\Support\Facades\Storage;
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

//        Queue::after(function (JobProcessed $event) {
//            Log::info($event->connectionName);
//        });

        Advert::deleted(function (Advert $advert) {
            $unix = strtotime($advert->created_at);
            $date = date('Y-m-d',$unix);
            $folder = strtotime($date);
            $path = '/public/uploads/images/'.$folder.'/'.$advert->id . '/';
            Storage::deleteDirectory($path);
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
