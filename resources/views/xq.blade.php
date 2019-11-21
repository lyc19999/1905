<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>详情</h3>
    <table border="1">
        <tr>
            <td>商品名称</td>
            <td>商品图片</td>
            <td>商品详情</td>
        </tr>
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v->goods_name}}</td>
            <td><img src="{{$v->goods_img}}" width="80px"></td>
            <td>{{$v->goods_desc}}</td>
        </tr>
            @endforeach
    </table>
</body>
</html>
