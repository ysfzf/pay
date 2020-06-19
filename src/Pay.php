<?php
namespace Ycpfzf\Pay;

use Illuminate\Support\Facades\Facade;

/**
 * Class
 * @package Ycpfzf\Pay
 * @method static  \Ycpfzf\Pay\PayClient money(float $money)  支付金额
 * @method static  \Ycpfzf\Pay\PayClient subject(string $subject) 支付说明
 * @method static  \Ycpfzf\Pay\PayClient outTradeNo(string $out_trade_no) 自定的支付订单号
 * @method static  \Ycpfzf\Pay\PayClient wechat() 微信支付
 * @method static  \Ycpfzf\Pay\PayClient alipay()  支付宝支付
 * @method static  \Ycpfzf\Pay\PayClient openid(string $openid) openid
 * @method static  \Ycpfzf\Pay\PayClient app(array $config)      APP 支付
 * @method static  \Ycpfzf\Pay\PayClient pos(array $config)      刷卡支付
 * @method static  \Ycpfzf\Pay\PayClient scan(array $config)     扫码支付
 * @method static  \Ycpfzf\Pay\PayClient transfer(array $config) 帐户转账/企业付款
 * @method static  \Ycpfzf\Pay\PayClient wap(array $config)      手机网站支付/H5支付
 * @method static  \Ycpfzf\Pay\PayClient web(array $config)      电脑支付
 * @method static  \Ycpfzf\Pay\PayClient mini(array $config)     小程序支付
 * @method static  \Ycpfzf\Pay\PayClient groupRedpack(array $config) 分裂红包
 * @method static  \Ycpfzf\Pay\PayClient miniapp(array $config)      小程序支付
 * @method static  \Ycpfzf\Pay\PayClient mp(array $config)           公众号支付
 * @method static  \Ycpfzf\Pay\PayClient redpack(array $config)      普通红包
 *
 * @see \Ycpfzf\Pay\PayClient
 *
 */
class Pay extends Facade
{
    static function getFacadeAccessor()
    {
        $config=config('pay');
        return new PayClient($config);
    }
}
