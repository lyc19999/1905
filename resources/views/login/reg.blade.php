@extends('layouts.shop')
@section('title','商城注册')

@section('content')
    <script src="/js/jquery.js"></script>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="maincont">
        <header>
            <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
            <div class="head-mid">
                <h1>会员注册</h1>
            </div>
        </header>
        <div class="head-top">
            <img src="/static/index/images/head.jpg" />
        </div><!--head-top/-->
        <form action="{{url('/reg_do')}}" method="post" class="reg-login">
            <h3>已经有账号了？点此<a class="orange" href="login.html">登陆</a></h3>
            <div class="lrBox">
                <div class="lrList">
                    <input type="text" name="email" id="email" placeholder="输入手机号码或者邮箱号" />
                    {{$errors->first('email')}}
                </div>
                <div class="lrList2"><input type="text" name="code" placeholder="输入短信验证码" />
                    <a href="javascript:;" id="code">获取验证码</a>
                </div>
                <div class="lrList">
                    <input type="password" name="password" placeholder="设置新密码（6-18位数字或字母）" />
                    {{$errors->first('password')}}
                </div>
                <div class="lrList"><input type="password" name="password_do" placeholder="再次输入密码" /></div>
            </div><!--lrBox/-->
            <div class="lrSub">
                <input type="submit" value="立即注册" />
            </div>
        </form><!--reg-login/-->
    </div>
    <script>
        $('#code').click(function(){
            var email=$("#email").val();
            $.ajax({
                url:"{{url('/send')}}",
                type:"post",
                data:{email:email},
                async:true,
            }).done(function(res){
                if(res==''){
                    alert('发送成功')
                }else{
                    alert('发送失败')
                }
            })
        });
    </script>
@include('public.footer')

@endsection
