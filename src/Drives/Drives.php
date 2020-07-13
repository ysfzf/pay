<?php
namespace Ycpfzf\Pay\Drives;

abstract class Drives
{
    protected $handle;

    //支付
    abstract function pay($name,$order);
    //退款
    abstract function refund($order);

    //支付通知
    abstract function notify($callback);

    function find($order){
        return $this->handle->find($order);
    }

    function cancel($order){
        return $this->handle->cancel($order);
    }

    function close($order){
        return $this->handle->close($order);
    }

    function verify(){
        return $this->handle->verify();
    }
}
