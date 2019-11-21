<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>

<body>

    <h3>商品展示</h3>
    <form action="">
        <select name="keys">
            <option value="0">--请选择--</option>
            <option value="admin_email" @if(isset($query['keys'])&&($query['keys']=='admin_email' )) selected @endif>邮箱</option>
            <option value="admin_tel" @if(isset($query['keys'])&&($query['keys']=='admin_tel' )) selected @endif>手机号</option>
        </select>
        <input type="text" name="keyval" value="{{$query['keyval']??''}}" placeholder="请输入邮箱/手机号">
        <input type="text" name="admin_name" value="{{$query['admin_name']??''}}" placeholder="请输入管理员名称">
        <input type="submit" value="搜索">
    </form>
    <table border="1">
        <tr>
            <td>管理员名称</td>
            <td>手机号</td>
            <td>头像</td>
            <td>性别</td>
            <td>邮箱</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->admin_name}}</td>
            <td>{{$v->admin_tel}}</td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->admin_head}}" width="50px" height="50px"></td>
            <!-- <td>{{$v->is_show==1?'显示':'不显示'}}</td> -->
            <td>@if ($v->admin_sex==1)男 @else 女 @endif</td>
            <td>{{$v->admin_email}}</td>
            <td>
                <a href="{{url('admin/edit',$v->admin_id)}}">编辑</a>
                <a href="{{url('admin/destroy',$v->admin_id)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{$data->appends($query)->links()}}
</body>

</html>
