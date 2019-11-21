<?php
namespace App\Http\Controllers;
use App\Http\Controllers;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Log;
use Yansongda\Pay\Pay;
use Yansongda\Pay\Log;

class AlipayController extends Controller{
    protected $config = [
        'app_id' => '2016101400681519',//你创建应用的APPID
        'notify_url' => 'http://www.1904.com/notify',//异步回调地址
        'return_url' => 'http://www.1904.com/return',//同步回调地址
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlbtVhT99YxcOv2KZxvVDwLq1u8iyheXVuWKVIMar1R0RXXLVmzsgWSQ8G/WJFZlRXzK9vK41NFv4jKee0JmyqvLMRdDm78POjBWG9hFX59zsQeQKSdOI1cmKlDIE9wGMt9fW/CEditFj5vmRhtUzg3An8aUHgUvVcz/HBUC5BRMo6ULTjtn61zst6uhqekTWLF5QyI6cGTDXQ3EenRZiFnGx6JXF4O0O1HN0AmVSyRJGt2TAX4t+4HfDgz1CbybTs2wwi1kc+KLruhSUdg0qL1byiRMM7v7UGqCH/k7GzZZjKeVvgXmMPhKWudeZaOKof8cerr1JWTiklTRxzA+KCQIDAQAB',//是支付宝公钥，不是应用公钥,  公钥要写成一行,不要换行
        // 加密方式： **RSA2**
        //密钥,密钥要写成一行,不要换行
        'private_key' => 'MIIEowIBAAKCAQEAuerQxQnok97WwJ+7vNBNrdZatU/w5eGT87LDojfUIQiq3YuDxDmwgdL2FpmS6Df9lcr0xMshbVXpW7iiYjMc2EvsmPqalgjOBZHU9jDSg91jCHczS0oZCW0QoNKoZZDf1TIc6WYOhesuP2my2ju/ODzOOgXBDjbJPBAZJ5DcWthEUgs9czoZfnJh2BAljLJzHHE6xcyme+yvCfClua3aiTuSRTlk/V8vwVOk5lRX/N7ZTc8E02ocCtUbsbwsAjhQV4goFbJBvYkFAPhaSSsgRVZYr3pLDVkbqNvkcO5CuOBR4tGx9q8M2dyvfM2i1fEwLqWlFKrmRLrC6k7p7gDvWwIDAQABAoIBAE8Dohir3mHCCkkxWeukJ+9is4htYjeBCI1BA24VBh3H/j5MBgNGdWKnkxkFye7RpP+dkyt0HU/HfHcT4EeV64NtuS9HCp4LPewWD4lWNJIAbA90AaPU6REdfjyraxBHYynLs4fqbO+zhSNEO9QOInW3Ofpk6ait1halzNsI8O3WU+iFlMUZJQmeIYCNZudtIlnpW3UXlfXUjP010MzIk6XpWlMuiskxaTn9rWFJyoqIWY26/uGJ3vozMU3gZQkd/FmFwq5cVX1pzvZ+OLKI063uDXOUnU/YfNHi6EwxewlMC5tG2HtG5EH028u5V9HMYk4SLeBYwiO/TXcej9MbsmECgYEA76umROxgPkDD0jOkq0mvTog1IK26d7COnTQSp4m9QVxrZPLlp2OJeowAwS64TbswfXBKyo9V50QRDfsYj+1Bgea+P4RYjf2Tz2/wcZaIIqNAtT7iqcwNePoR7/pvm559zp9bAfBbQCvNDcmPkRJEXOE7KdjxEXo6OlPBcHub6zECgYEAxpWZBs2yZdFHxpunA251U3sZijsK9UXJ0Zd9J8DOgSnTeXcL/GWi/MjzySMIncCl6VMvbL9vYuyhs6Yr4L51CGd8fWhSNnfXdp5RzcLKMrRxDxSNSnfm1JikDJH6awqMO2nljZDtBQXYI1OECUxMkOIdTdoZ7dKtmHnEDT4xiEsCgYAUkw2w+QHCFlk5IEnQkoDEIxk8du18/OEhSakYTNC8Xayye8+PMRJKPN6LtvEHazxcaFljTi63rbYxFw8iu+FVv3MxjLD1b4FS228usRd6sb0KUh2vKd82NXF4wmz2VQLDzBZJ8lJDDf+KYXU7pO/NcWBc1UzMjUuWWj5O462c4QKBgQCeJ1JCKtvjXvNM53Xxs6zZGXbTsgYeJMCAnaddW56bG5aCbB8tmjxeGiSdkbsw99aqpkdk0mmBXXfCvZrAWK6YTOLGdajUHEmK/LelqXajPzWzjuif4DIEKrSsFi5bxYC9aK8bOcqqb2cda0wCo7Nux8YS1JpF373Fa2SKL3f/VQKBgAETNKMqIo6sUKoMEC861Op58NqSe2ofnW/EBQ76WX0EDZG5NxzO3X9wHrg1reNlsDM+DQjkjcsN7shgs6DTIz6EmWsgsaScrgcaWlECsi4x1sHykBfqRanRiKKyfE/GeEFtpKtUx8VJuEAVvfJ+QpUyk5YmBNi2GgedZMIyNQq8',
        'log' => [ // optional
            'file' => './logs/alipay.log',
            'level' => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
            'type' => 'single', // optional, 可选 daily.
            'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
        ],
        'http' => [ // optional
            'timeout' => 5.0,
            'connect_timeout' => 5.0,
            // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
        ],
        'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
    ];
    public function Alipay()
    {
        $order = [
            'out_trade_no' => time(),
            'total_amount' => '0.1',
            'subject' => 'test subject - 测试',
        ];

        $alipay = Pay::alipay($this->config)->web($order);

        return $alipay;
    }

    public function AliPayReturn()
    {
        $data = Pay::alipay($this->config)->verify(); // 是的，验签就这么简单！

        // 订单号：$data->out_trade_no
        // 支付宝交易号：$data->trade_no
        // 订单总金额：$data->total_amount
    }

    public function AliPayNotify()
    {
        $alipay = Pay::alipay($this->config);

        try{
            $data = $alipay->verify(); // 是的，验签就这么简单！

            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况

            Log::debug('Alipay notify', $data->all());
        } catch (\Exception $e) {
            //$e->getMessage();
        }

        return $alipay->success();
    }
}
