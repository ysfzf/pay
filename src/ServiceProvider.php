<?php
namespace Ycpfzf\Vcode;

use Illuminate\Support\ServiceProvider;

class VcodeServiceProvider extends ServiceProvider
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
