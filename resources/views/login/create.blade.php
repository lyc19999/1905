<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>

<body>
    <form action="{{url('login/store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        账号: <input type="text" name="admin_name"><br>
        密码: <input type="password" name="admin_pwd"><br>
        <input type="submit" value="登陆" id="submit">
    </form>
</body>

</html>
