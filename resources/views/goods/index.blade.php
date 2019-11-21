<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table border=1>
    <tr>
        <td>编号</td>
        <td>商品名称</td>
        <td>商品价格</td>
        <td>商品图片</td>
        <td>是否新品</td>
        <td>是否精品</td>
        <td>是否热销</td>
        <td>是否上架</td>
        <td>商品品牌</td>
        <td>商品分类</td>
        <td>操作</td>
    </tr>
    @foreach ($goodsInfo as $v)
        <tr>
            <td>{{$v->goods_id}}</td>
            <td>{{$v->goods_name}}</td>
            <td>{{$v->goods_price}}</td>
            <td><img src="{{env('UPLODE_URL')}}{{$v->goods_img}}" width="100"></td>
            <td>{{$v->is_new==1?'√':'×'}}</td>
            <td>{{$v->is_best==1?'√':'×'}}</td>
            <td>{{$v->is_hot==1?'√':'×'}}</td>
            <td>{{$v->is_up==1?'√':'×'}}</td>
            <td>{{$v->brand_name}}</td>
            <td>{{$v->cate_name}}</td>
            <td>
                <a href="{{url('goods/edit',$v->goods_id)}}">编辑</a>
                <a href="{{url('goods/destroy',$v->goods_id)}}">删除</a>
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>
