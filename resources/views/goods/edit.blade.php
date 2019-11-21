<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{url('goods/update',$goodsInfo->goods_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <table>
        <tr>
            <td>商品名称</td>
            <td><input type="text" name="goods_name" placeholder="商品名称" value="{{$goodsInfo->goods_name}}"/></td>
        </tr>
        <tr>
            <td>商品价格</td>
            <td><input type="text" name="goods_price" placeholder="商品价格" value="{{$goodsInfo->goods_price}}"/></td>
        </tr>
        <tr>
            <td>商品库存</td>
            <td><input type="text" name="goods_num" placeholder="商品库存" value="{{$goodsInfo->goods_num}}"/></td>
        </tr>
        <tr>
            <td>所属分类</td>
            <td>
                <select name="cate_id">
                    @foreach ($cateInfo as $v)
                        @if($goodsInfo->cate_id==$v->cate_id)
                            <option value="{{$v->cate_id}}" selected>{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
                        @else
                            <option value="{{$v->cate_id}}">{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
                        @endif
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>商品品牌</td>
            <td>
                <select name="brand_id" id="">
                    @foreach ($brandInfo as $v)
                        @if($goodsInfo->brand_id==$v->brand_id)
                            <option value="{{$v->brand_id}}" selected>{{str_repeat('|--',$v->level)}}{{$v->brand_name}}</option>
                        @else
                            <option value="{{$v->brand_id}}">{{str_repeat('|--',$v->level)}}{{$v->brand_name}}</option>
                        @endif
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>是否新品</td>
            <td>
                @if($goodsInfo->is_new==1)
                    <input type="radio" name="is_new" value="1"checked>是
                    <input type="radio" name="is_new" value="2">否
                @else
                    <input type="radio" name="is_new" value="1">是
                    <input type="radio" name="is_new" value="2"checked>否
                @endif
            </td>
        </tr>
        <tr>
            <td>是否精品</td>
            <td>
                @if($goodsInfo->is_best==1)
                    <input type="radio" name="is_best" value="1"checked>是
                    <input type="radio" name="is_best" value="2">否
                @else
                    <input type="radio" name="is_best" value="1">是
                    <input type="radio" name="is_best" value="2"checked>否
                @endif
            </td>
        </tr>
        <tr>
            <td>是否热销</td>
            <td>
                @if($goodsInfo->is_hot==1)
                    <input type="radio" name="is_hot" value="1"checked>是
                    <input type="radio" name="is_hot" value="2">否
                @else
                    <input type="radio" name="is_hot" value="1">是
                    <input type="radio" name="is_hot" value="2"checked>否
                @endif
            </td>
        </tr>
        <tr>
            <td>是否上架</td>
            <td>
                @if($goodsInfo->is_up==1)
                    <input type="radio" name="is_up" value="1"checked>是
                    <input type="radio" name="is_up" value="2">否
                @else
                    <input type="radio" name="is_up" value="1">是
                    <input type="radio" name="is_up" value="2"checked>否
                @endif
            </td>
        </tr>
        <tr>
            <td>商品图片</td>
            <td>
                <img src="{{env('UPLODE_URL')}}{{$goodsInfo->goods_img}}" width="100">
                <input type="file" name="goods_img" id="form-field-3" />
            </td>
        </tr>
        <tr>
            <td>商品详情</td>
            <td>
                <textarea name="goods_desc" id="" cols="30" rows="10">{{$goodsInfo->goods_desc}}</textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="修改"></td>
        </tr>
    </table>
</form>
</body>
</html>
