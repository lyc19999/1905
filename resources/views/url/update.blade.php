<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="{{asset('/js/jquery.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <form action="{{url('url/update',$data->w_id)}}" method="post" enctype="multipart/form-data">
        @csrf
        网站名称: <input type="text" name="w_name" value="{{$data->w_name}}" id="name"><span style="color: red;">{{$errors->first('w_name')}}</span><br>
        网站网址: <input type="text" name="w_url" value="{{$data->w_url}}" id="url"><span style="color: red;">{{$errors->first('w_name')}}</span><br>
        链接类型: @if($data->w_lei==1)
                     <input type="radio" name="w_lei" value="1" checked>logo链接
                     <input type="radio" name="w_lei" value="2">文字链接<br>
                 @else
                     <input type="radio" name="w_lei" value="1">logo链接
                     <input type="radio" name="w_lei" value="2" checked>文字链接<br>
                 @endif
        <img src="{{env('UPLOAD_URL')}}{{$data->w_logo}}" width="80px" height="50px">
        图片logo: <input type="file" name="w_logo"><br>
        网站联系人: <input type="text" name="w_man" value="{{$data->w_man}}"><br>
        网站介绍: <textarea name="w_desc">{{$data->w_desc}}</textarea><br>
        是否显示: @if($data->w_status==1)
                     <input type="radio" name="w_status" value="1" checked>是
                     <input type="radio" name="w_status" value="2">否<br>
                 @else
                     <input type="radio" name="w_status" value="1">是
                     <input type="radio" name="w_status" value="2" checked>否<br>
                 @endif
                    <input type="submit" value="修改">
    </form>
</body>

</html>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#name').blur(function() {
        $(this).next().remove();
        var name = $(this).val();
        var reg = /^[\u4e00-\u9fa5a-zA-z0-9_]{2,12}$/;
        if (!reg.test(name)) {
            $(this).after("<p style=color:red;>管理员名称由数字字母下划线组成2-12位</p>")
        }
        $.ajax({
            url: "{{url('url/name_do')}}",
            type: 'post',
            data: {name: name},
            async: false,
        }).done(function(res) {
            if (res > 0) {
                $('#name').after("<p style=color:red;>网址名称已存在</p>");
                nameflag = false;
            }
        })
    });
    $('#url').blur(function() {
        $(this).next().remove();
        var url = $(this).val();
        var reg = /^http:\/\/([\w.]+\/?)\S*$/;
        if(!reg.test(url)){
            $(this).after("<p style=color:red;>网站网址必须以http开头</p>")
        }
    });

    $('#submit').click(function(){
        var nameflag = urlflag =true;
        $("#name").next().remove();
        var name = $("#name").val();
        var reg = /^[\u4e00-\u9fa5a-zA-z0-9_]{2,12}$/;
        if (!reg.test(name)) {
            $("#name").after("<p style=color:red;>管理员名称由数字字母下划线组成2-12位</p>")
        }
        var w_id="{{$data->w_id}}";
        $.ajax({
            url: "{{url('url/name_do')}}",
            type: 'post',
            data: {name: name,w_id:w_id},
            async: false,
        }).done(function(res) {
            if (res > 0) {
                $('#name').after("<p style=color:red;>网址名称已存在</p>");
                nameflag = false;
            }
        })

        $(this).next().remove();
        var url = $(this).val();
        var reg = /^http:\/\/([\w.]+\/?)\S*$/;
        if(!reg.test(url)){
            $("#url").after("<p style=color:red;>网站网址必须以http开头</p>")
            urlflag=false;
        }
        if (nameflag && urlflag) {
            $('form').submit();
        }
    });
</script>
