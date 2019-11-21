<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{url('goods/store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <table>
        <tr>
            <td>商品名称</td>
            <td><input type="text" name="goods_name" placeholder="商品名称"/></td>
        </tr>
        <tr>
            <td>商品价格</td>
            <td><input type="text" name="goods_price" placeholder="商品价格"/></td>
        </tr>
        <tr>
            <td>商品库存</td>
            <td><input type="text" name="goods_num" placeholder="商品库存"/></td>
        </tr>
        <tr>
            <td>所属分类</td>
            <td>
                <select name="cate_id">
                    @foreach ($cateInfo as $v)
                        <option value="{{$v->cate_id}}">{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>商品品牌</td>
            <td>
                <select name="brand_id" id="">
                    @foreach ($goodsInfo as $v)
                        <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>是否新品</td>
            <td>
                <input type="radio" name="is_new" value="1" checked/>是
                <input type="radio" name="is_new" value="2" />否
            </td>
        </tr>
        <tr>
            <td>是否精品</td>
            <td>
                <input type="radio" name="is_best" value="1" checked/>是
                <input type="radio" name="is_best" value="2" />否
            </td>
        </tr>
        <tr>
            <td>是否热销</td>
            <td>
                <input type="radio" name="is_hot" value="1" checked/>是
                <input type="radio" name="is_hot" value="2" />否
            </td>
        </tr>
        <tr>
            <td>是否上架</td>
            <td>
                <input type="radio" name="is_up" value="1" checked/>是
                <input type="radio" name="is_up" value="2" />否
            </td>
        </tr>
        <tr>
            <td>商品图片</td>
            <td>
                <input type="file" name="goods_img" id="form-field-3" />
            </td>
        </tr>
        <tr>
            <td>商品详情</td>
            <td>
                <textarea name="goods_desc" id="" cols="30" rows="10"></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="添加"></td>
        </tr>
    </table>
</form>
</body>
</html>
