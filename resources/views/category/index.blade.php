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
            <td>分类id</td>
            <td>分类名称</td>
            <td>是否展示</td>
            <td>是否在导航栏展示</td>
            <td>操作</td>
        </tr>
        @foreach($cateInfo as $v)
        <tr>
            <td>{{str_repeat('--',$v->level)}}{{$v->cate_id}}</td>
            <td>{{str_repeat('--',$v->level)}}{{$v->cate_name}}</td>
            <td>@if($v->cate_show==1) 是 @else 否 @endif</td>
            <td>@if($v->cate_nav_show==1) 是 @else 否 @endif</td>
            <td>
                <a href="{{url('category/edit',$v->cate_id)}}">编辑</a>
                <a href="{{url('category/destroy',$v->cate_id)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>
