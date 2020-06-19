<?php
namespace Ycpfzf\Pay\Drives;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Yansongda\Pay\Log;
use Yansongda\Pay\Pay;

class Wechat extends Drives
{
    
    function __construct($config)
    {
        $this->hanld=Pay::wechat($config);
    }

    //支付
    function pay($name, $arguments)
    {
        $pay= $this->hanld->$name($arguments);
        if($pay instanceof JsonResponse || $pay instanceof Response){
            $content=$pay->getContent();
            if($content){
                return json_decode($content,true);
            }
            return false;
        }
        return $pay;
    }

    function refund($order){
        $pay = $this->hanld->refund($order);
        $ret=$pay->toArray();
        Log::debug('Wechat refund',$ret);
        if($ret){
            return [
                'status'=>$ret['return_code']=='SUCCESS',
                'trade_no'=>$ret['transaction_id']
            ];
        }
        throw new \Exception('Requret faild');
    }

    function notify($callback)
    {
        // TODO: Implement notify() method.
        $data = $this->verify();
        $ret=$data->all();
        Log::debug('Wechat notify',$ret );
        if(isset($ret['out_trade_no'])){
            $notify= [
                'out_trade_no'=>$ret['out_trade_no'],
                'status'=>$ret['return_code'] == 'SUCCESS'?true:false,
                'notify_no'=>$ret['transaction_id'],
                'money'=>$ret['total_fee']/100,
                'appid'=>$ret['appid'],
                'mch_id'=>$ret['mch_id'],
                'type'=>'wechat',
            ];
            call_user_func_array($callback,['notify'=>$notify]);
        }else{
            throw new \Exception('未知out_trade_id');
        }
        return $this->hanld->success()->send();
    }
}
