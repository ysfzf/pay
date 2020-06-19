<?php
namespace Ycpfzf\Pay;

use Illuminate\Support\Facades\Facade;

/**
 * Class 
 * @package Ycpfzf\Pay
 * @method static  \Ycpfzf\Pay\PayClient money()
 *
 * @see \Ycpfzf\Pay\PayClient
 *
 */
class Vcode extends Facade
{

    static function getFacadeAccessor()
    {
        $config=config('pay');
        return new PayClient($config);

    }

     
}
