<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class wapAlipayController extends Controller
{
    public function Alipay($id){
        $user_id=session('id');
        $where=[
            ['order_id','=',$id],
            ['user_id','=',$user_id],
            ['is_del','=',1]
        ];
        $data=Order::where($where)->first();

        require_once app_path('libs/alipay/wappay/service/AlipayTradeService.php');
        require_once app_path('libs/alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php');
        $config=config('alipay');
//        if (!empty($_POST['WIDout_trade_no'])&& trim($_POST['WIDout_trade_no'])!=""){
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = $data['order_no'];

            //订单名称，必填
            $subject = '1904 wshop';

            //付款金额，必填
            $total_amount = $data['order_amount'];

            //商品描述，可空
            $body = '';

            //超时时间
            $timeout_express="1m";

            $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setTimeExpress($timeout_express);

            $payResponse = new \AlipayTradeService($config);
            $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

            return ;
//        }
    }
}
