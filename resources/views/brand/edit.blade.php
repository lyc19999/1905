<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="{{url('brand/update',$data->brand_id)}}" method="post" enctype="multipart/form-data">
{{--<form action="{{url('brand/add_do')}}" method="post">--}}
    {{csrf_field()}}
    品牌名称: <input type="text" name="brand_name" value="{{$data->brand_name}}"><br>
    品牌网址: <input type="text" name="brand_url" value="{{$data->brand_url}}"><br>
    品牌logo: <input type="file" name="brand_logo"><br>
    <img src="{{env('UPLOAD_URL')}}{{$data->brand_logo}}" width="100px" height="100px">
    是否展示:  <input type="radio" name="is_show" value="1" @if($data->is_show==1)checked @endif>是
              <input type="radio" name="is_show" value="2" @if($data->is_show==2)checked @endif>否<br>
    <input type="submit" value="修改">
</form>
</body>
</html>
