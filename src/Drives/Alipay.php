<?php
namespace Ycpfzf\Pay\Drives;
use Yansongda\Pay\Log;
use Yansongda\Pay\Pay;
use Ycpfzf\Pay\Notify;

class Alipay extends Drives
{

    function __construct($config)
    {
        $this->handle=Pay::alipay($config);
    }

    //支付
    function pay($name, $arguments)
    {
        return $this->handle->$name($arguments)->getContent();
    }

    //退款
    function refund($order)
    {
        $pay = $this->handle->refund($order);
        $ret=$pay->toArray();

        if($ret){
            return [
                'status'=>$ret['code']==10000,
                'trade_no'=>$ret['trade_no']
            ];
        }
        throw new \Exception('Requret faild');
    }

    //通知
    function notify($callback)
    {
        $data = $this->verify();
        $ret=$data->all();
        Log::debug('Alipay notify',$ret);
        if(isset($ret['out_trade_no'])){
            $notify=new Notify();
            $notify->money=$ret['buyer_pay_amount'];
            $notify->status=$ret['trade_status']=='TRADE_SUCCESS';
            $notify->out_trade_no=$ret['out_trade_no'];
            $notify->type='alipay';
            $notify->appid=$ret['app_id'];
            $notify->mch_id=0;
            $notify->notify_no=$ret['trade_no'];
            call_user_func_array($callback,['notify'=>$notify]);
        }else{
            throw new \Exception('Undefined out_trade_id');
        }
        return $this->handle->success();
    }
}
