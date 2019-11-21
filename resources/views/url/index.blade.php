<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="{{asset('/js/jquery.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <h3>商品展示</h3>
    <form action="">
        <input type="text" name="w_name" value="{{$query['w_name']??''}}" placeholder="请输入网站名称">
        <input type="submit" value="搜索">
    </form>
    <table border="1">
        <tr>
            <td>ID</td>
            <td>网站名称</td>
            <td>网站网址</td>
            <td>链接类型</td>
            <td>图片logo</td>
            <td>网站联系人</td>
<td>网站介绍</td>
            <td>是否显示</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr w_id="{{$v->w_id}}">
            <td>{{$v->w_id}}</td>
            <td>{{$v->w_name}}</td>
            <td>{{$v->w_url}}</td>
            <td>@if ($v->w_lei==1)logo链接 @else 文字链接 @endif</td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->w_logo}}" width="80px" height="50px"></td>
            <td>{{$v->w_man}}</td>
            <td>{{$v->w_desc}}</td>
            <td>@if ($v->w_status==1)显示 @else 不显示 @endif</td>
            <td>
                <a href="{{url('url/edit',$v->w_id)}}">编辑</a>
                <a href="" id="del">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{$data->appends($query)->links()}}
</body>

</html>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
        $(document).on('click','#del',function(){
            var _this=$(this);
            var w_id=_this.parents('tr').attr('w_id');
            $.ajax({
                url: "{{url('url/destroy')}}",
                type:"get",
                data: {w_id:w_id},
                async: false,
            }).done(function(res) {
                if (res > 0) {
                    alert(res);
                }
            })
        })
    });

</script>
