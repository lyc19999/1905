<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

    <h3>商品展示</h3>
    <table border="1">
        <tr>
            <td>商品名称</td>
            <td>商品网址</td>
            <td>品牌logo</td>
            <td>是否展示</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
            <tr>
                <td>{{$v->brand_name}}</td>
                <td>{{$v->brand_url}}</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}" width="80px" height="80px"></td>
{{--                <td>{{$v->is_show==1?'显示':'不显示'}}</td>--}}
                <td>@if($v->is_show==1)显示@else不显示@endif</td>
                <td>
                    <a href="{{url('brand/edit',$v->brand_id)}}">编辑</a>
                    <a href="{{url('brand/delete',$v->brand_id)}}">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
