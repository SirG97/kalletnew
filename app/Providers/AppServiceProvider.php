<?php

namespace App\Providers;

use App\Models\Wallet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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

        Schema::defaultStringLength(191);
        View::composer('*', function($view){
            if(auth()->check()){
                $balance = Wallet::where('user_id', auth()->user()->id)->first();
                if($balance === null){
                    $balance = number_format(0,2,'.', ',');
                }else{
                    $balance = number_format($balance->balance, 2,'.', ',');
                }
                $view->with('balance', $balance);
            }
        });
    }
}
