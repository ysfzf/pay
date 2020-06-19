<?php
namespace Ycpfzf\Pay\Drives;

abstract class Drives
{
    protected $hanld;

    //支付
    abstract function pay($name,$order);
    //退款
    abstract function refund($order);

    //支付通知
    abstract function notify($callback);

    function find($order){
        return $this->hanld->find($order);
    }

    function cancel($order){
        return $this->hanld->cancel($order);
    }

    function close($order){
        return $this->hanld->close($order);
    }

    function verify(){
        return $this->hanld->verify();
    }
}
