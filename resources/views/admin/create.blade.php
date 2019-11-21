<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="{{asset('/js/jquery.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <form action="{{url('admin/store')}}" method="post" enctype="multipart/form-data">
        <!-- <form action="{{url('brand/add_do')}}" method="post"> -->
        @csrf
        用户名称: <input type="text" name="admin_name" id="name"><span style=color:red;>{{$errors->first('admin_name')}}</span><br>
        用户密码: <input type="password" name="admin_pwd" id="pwd1"><span style=color:red;>{{$errors->first('admin_pwd')}}</span><br>
        确认密码: <input type="password" name="pwd" id="pwd2"><span style=color:red;>{{$errors->first('pwd')}}</span><br>
        手机号: <input type="tel" name="admin_tel" id="tel"><span style=color:red;>{{$errors->first('admin_tel')}}</span><br>
        头像: <input type="file" name="admin_head"><span style=color:red;>{{$errors->first('admin_head')}}</span><br>
        性别: <input type="radio" name="admin_sex" value="1" checked>男
        <input type="radio" name="admin_sex" value="2">女<br>
        邮箱: <input type="text" name="admin_email" id="email"><span style=color:red;>{{$errors->first('admin_email')}}</span><br>
        <input type="submit" value="提交" id="submit">
    </form>
</body>

</html>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //验证名称
    $('#name').blur(function() {
        $(this).next().remove();
        var name = $(this).val();
        var reg = /^[\u4e00-\u9fa5a-zA-z0-9_]{2,12}$/;
        if (!reg.test(name)) {
            $(this).after("<p style=color:red;>管理员名称由数字字母下划线组成2-12位</p>")
        }

        $.ajax({
            url: "{{url('admin/name_do')}}",
            type: 'post',
            data: {name: name},
            async: false,
        }).done(function(res) {
            if (res > 0) {
                $('#name').after("<p style=color:red;>管理员名称已存在</p>");
                nameflag = false;
            }
        })
    });

    //验证手机号
    $('#tel').blur(function() {
        $(this).next().remove();
        var tel = $(this).val();
        var reg = /^1[356789]\d{9}$/;
        if (!reg.test(tel)) {
            $(this).after("<p style=color:red;>手机号格式不正确</p>")
        }
    });

    //验证密码
    $('#pwd1').blur(function() {
        $(this).next().remove();
        var pwd1 = $(this).val();
        var reg = /^\w{3,9}$/;
        if (!reg.test(pwd1)) {
            $(this).after("<p style=color:red;>密码有数字字母下划线组成</p>")
        }
    });

    //验证确认密码
    $('#pwd2').blur(function() {
        var _this = $(this);
        _this.next().remove();
        var pwd1 = $('#pwd1').val();
        var pwd2 = _this.val();
        if (pwd2 != pwd1) {
            $(this).after("<p style=color:red;>确认密码与密码不一致</p>")
        }
    });

    //验证邮箱
    $('#email').blur(function() {
        var _this = $(this);
        _this.next().remove();
        var email = _this.val();
        var reg = /^\w+@\w+\.com$/;
        if (!reg.test(email)) {
            $(this).after("<p style=color:red;>邮箱格式有误</p>")
        }
    });

    //阻止提交
    $('#submit').click(function() {
        var nameflag = pwd1flag = emailflag = telflag = true;
        var name = $('#name').val();
        var reg1 = /^[\u4e00-\u9fa5a-zA-z0-9_]{2,12}$/;
        if (!reg1.test(name)) {
            $('#name').after("<p style=color:red;>管理员名称由数字字母下划线组成2-12位</p>")
        }

        $.ajax({
            url: "{{url('admin/name_do')}}",
            type: 'post',
            data: {
                name: name
            },
            async: false,
        }).done(function(res) {
            if (res > 0) {
                $('#name').after("<p style=color:red;>管理员名称已存在</p>");
                nameflag = false;
            }
        })

        var tel = $('#tel').val();
        var reg2 = /^1[356789]\d{9}$/;
        if (!reg2.test(tel)) {
            $('#tel').after("<p style=color:red;>手机号格式不正确</p>")
            telflag = false;
        }

        var pwd1 = $('#pwd1').val();
        var reg3 = /^\w{3,9}$/;
        if (!reg3.test(pwd1)) {
            $('#pwd1').after("<p style=color:red;>密码有数字字母下划线组成</p>")
            pwd1flag = false;
        }

        var email = $('#email').val();
        var reg4 = /^\w+@\w+\.com$/;
        if (!reg4.test(email)) {
            $('#email').after("<p style=color:red;>邮箱格式有误</p>")
            emailflag = false;
        }

        if (nameflag && telflag && pwd1flag && emailflag) {
            $('form').submit();
        }
    });
</script>
