<?php
$config = array (
        //应用ID,您的APPID。
        'app_id' => "2016101400681519",

        //商户私钥
        'merchant_private_key' => "MIIEowIBAAKCAQEAuerQxQnok97WwJ+7vNBNrdZatU/w5eGT87LDojfUIQiq3YuDxDmwgdL2FpmS6Df9lcr0xMshbVXpW7iiYjMc2EvsmPqalgjOBZHU9jDSg91jCHczS0oZCW0QoNKoZZDf1TIc6WYOhesuP2my2ju/ODzOOgXBDjbJPBAZJ5DcWthEUgs9czoZfnJh2BAljLJzHHE6xcyme+yvCfClua3aiTuSRTlk/V8vwVOk5lRX/N7ZTc8E02ocCtUbsbwsAjhQV4goFbJBvYkFAPhaSSsgRVZYr3pLDVkbqNvkcO5CuOBR4tGx9q8M2dyvfM2i1fEwLqWlFKrmRLrC6k7p7gDvWwIDAQABAoIBAE8Dohir3mHCCkkxWeukJ+9is4htYjeBCI1BA24VBh3H/j5MBgNGdWKnkxkFye7RpP+dkyt0HU/HfHcT4EeV64NtuS9HCp4LPewWD4lWNJIAbA90AaPU6REdfjyraxBHYynLs4fqbO+zhSNEO9QOInW3Ofpk6ait1halzNsI8O3WU+iFlMUZJQmeIYCNZudtIlnpW3UXlfXUjP010MzIk6XpWlMuiskxaTn9rWFJyoqIWY26/uGJ3vozMU3gZQkd/FmFwq5cVX1pzvZ+OLKI063uDXOUnU/YfNHi6EwxewlMC5tG2HtG5EH028u5V9HMYk4SLeBYwiO/TXcej9MbsmECgYEA76umROxgPkDD0jOkq0mvTog1IK26d7COnTQSp4m9QVxrZPLlp2OJeowAwS64TbswfXBKyo9V50QRDfsYj+1Bgea+P4RYjf2Tz2/wcZaIIqNAtT7iqcwNePoR7/pvm559zp9bAfBbQCvNDcmPkRJEXOE7KdjxEXo6OlPBcHub6zECgYEAxpWZBs2yZdFHxpunA251U3sZijsK9UXJ0Zd9J8DOgSnTeXcL/GWi/MjzySMIncCl6VMvbL9vYuyhs6Yr4L51CGd8fWhSNnfXdp5RzcLKMrRxDxSNSnfm1JikDJH6awqMO2nljZDtBQXYI1OECUxMkOIdTdoZ7dKtmHnEDT4xiEsCgYAUkw2w+QHCFlk5IEnQkoDEIxk8du18/OEhSakYTNC8Xayye8+PMRJKPN6LtvEHazxcaFljTi63rbYxFw8iu+FVv3MxjLD1b4FS228usRd6sb0KUh2vKd82NXF4wmz2VQLDzBZJ8lJDDf+KYXU7pO/NcWBc1UzMjUuWWj5O462c4QKBgQCeJ1JCKtvjXvNM53Xxs6zZGXbTsgYeJMCAnaddW56bG5aCbB8tmjxeGiSdkbsw99aqpkdk0mmBXXfCvZrAWK6YTOLGdajUHEmK/LelqXajPzWzjuif4DIEKrSsFi5bxYC9aK8bOcqqb2cda0wCo7Nux8YS1JpF373Fa2SKL3f/VQKBgAETNKMqIo6sUKoMEC861Op58NqSe2ofnW/EBQ76WX0EDZG5NxzO3X9wHrg1reNlsDM+DQjkjcsN7shgs6DTIz6EmWsgsaScrgcaWlECsi4x1sHykBfqRanRiKKyfE/GeEFtpKtUx8VJuEAVvfJ+QpUyk5YmBNi2GgedZMIyNQq8",

		//异步通知地址
		'notify_url' => "http://工程公网访问地址/alipay.trade.wap.pay-PHP-UTF-8/notify_url.php",

		//同步跳转
		'return_url' => "http://mitsein.com/alipay.trade.wap.pay-PHP-UTF-8/return_url.php",

        //编码格式
        'charset' => "UTF-8",

        //签名方式
        'sign_type' => "RSA2",

        //支付宝网关
        'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlbtVhT99YxcOv2KZxvVDwLq1u8iyheXVuWKVIMar1R0RXXLVmzsgWSQ8G/WJFZlRXzK9vK41NFv4jKee0JmyqvLMRdDm78POjBWG9hFX59zsQeQKSdOI1cmKlDIE9wGMt9fW/CEditFj5vmRhtUzg3An8aUHgUvVcz/HBUC5BRMo6ULTjtn61zst6uhqekTWLF5QyI6cGTDXQ3EenRZiFnGx6JXF4O0O1HN0AmVSyRJGt2TAX4t+4HfDgz1CbybTs2wwi1kc+KLruhSUdg0qL1byiRMM7v7UGqCH/k7GzZZjKeVvgXmMPhKWudeZaOKof8cerr1JWTiklTRxzA+KCQIDAQAB",

);
