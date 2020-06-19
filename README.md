## 使用方法
测试完善中....

### 安装

1  使用composer安装依赖
```php
composer require ycpfzf/pay
```

2  发布资源
```php
php artisan vendor:publish
```
在列表中选择 Ycpfzf\Pay\ServiceProvider，运行完毕会在config文件夹生成配置文件pay.php
env文件配置示例
```php
ALI_APP_ID= 
ALI_PUBLIC_KEY= 
ALI_PRIVATE_KEY= 
WECHAT_APP_ID=
WECHAT_MINIAPP_ID=
WECHAT_APPID= 
WECHAT_MCH_ID= 
WECHAT_KEY= 
```

### 使用
#### 支付

* alipay()  使用支付宝支付
* wechat()  使用微信支付
* money($money) 支付金额，不管是支付宝还是微信，统一单位是元。
* outTradeNo($out_trade_no) 商户定义的支付订单号
* subject($subject)  支付说明
* openid($openid)  JSAPI支付必须传openid

各支付类型详见[文档](https://pay.yanda.net.cn/docs/2.x)

```php
use Ycpfzf\Pay\Pay;

Pay::alipay()->outTradeNo($outid)->money(0.1)->subject('测试')->app(); //使用支付宝的app支付0.1元
```

#### 退款

* 退款方法 refund($type='',$orderTotalFee=0)
* $type表示类别 ，微信app支付的是app,微信小程序支付的是miniapp,其它方式不用
* $orderTotalFee表示订单金额，为0时表示和退款金额一样，支付宝不用

```php
use Ycpfzf\Pay\Pay;

Pay::wechat()->outTradeNo($outid)->money(0.1)->subject('7天无理由退款')->refund('app'); 

//返回结果
[
    'status'=>true,  //退款是否成功
    'trade_no'=>'xxxx'  //平台返回的退款编号
]
```


#### 异步通知

* 通知方法 notify($callback)

```php
use Ycpfzf\Pay\Pay;

Pay::notify(function($data){
    
       .....
});

//回调函数中参数$data
[
    'out_trade_no'=>'xxx'  //商户订单编号 
    'status'=>true,  //支付是否成功
    'notify_no'=>//平台编号,
    'money'=>0.10  //支付金额，单位统一都是元,
    'appid'=>'xxx',   //商户申请的appid
    'mch_id'=>'xxx',  //微信时返回mch_id,支付宝返回0
    'type'=>'wechat',  //类别 wechat 或 alipay

]
```
