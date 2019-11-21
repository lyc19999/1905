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
    <h3>列表展示</h3>
    <table border="1">
        <tr>
            <td>商品id</td>
            <td>商品名称</td>
            <td>商品图片</td>
            <td>商品详情</td>
            <td>操作</td>
        </tr>
        @foreach($data as $k=>$v)
            <tr>
                <td>{{$v->goods_id}}</td>
                <td>{{$v->goods_name}}</td>
                <td><img src="{{$v->goods_img}}" width="80px"></td>
                <td>{{$v->goods_desc}}</td>
                <td><a href="{{url('goods/xq',$v->goods_id)}}">详情</a></td>
            </tr>
        @endforeach
    </table>
{{$data->links()}}
</body>
</html>
