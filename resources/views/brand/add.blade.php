<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="{{route('adddo')}}" method="post" enctype="multipart/form-data">
{{--<form action="{{url('brand/add_do')}}" method="post">--}}
    {{csrf_field()}}
    品牌名称: <input type="text" name="brand_name"><br>
    品牌网址: <input type="text" name="brand_url"><br>
    品牌logo: <input type="file" name="brand_logo"><br>
    是否展示: <input type="radio" name="is_show" value="1" checked>是
              <input type="radio" name="is_show" value="2">否<br>
    <button>提交</button>
</form>
</body>
</html>
