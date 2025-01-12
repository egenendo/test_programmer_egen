<?php

namespace App\Providers;
use Carbon\Carbon;
use GuzzleHttp\Client;

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
        app()->singleton('generateAuth', function () {
            $now = Carbon::now('Asia/Shanghai');
            $sequence_Time = $now->hour;
            $sequence = 'C' . str_pad($sequence_Time, 2, '0', STR_PAD_LEFT);
            $username = 'tesprogrammer' . $now->format('d') . $now->format('m') . $now->format('y') . $sequence;
            $password = 'bisacoding-' . $now->format('d') . '-' . $now->format('m') . '-' . $now->format('y');
            $hashedPassword = md5($password); 

            return [
                'username' => $username,
                'password' => $hashedPassword,
            ];
        });
    }
}
