<?php
namespace Ycpfzf\Pay;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function register()
    {
       //
    }

    public function boot()
    {

        $this->publishes([
            __DIR__.'/../config/pay.php' => config_path('pay.php'),

        ]);
    }


}
