<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="{{asset('/js/jquery.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <form action="{{url('category/update',$goodsInfo->cate_id)}}" method="post" enctype="multipart/form-data">
        <!-- <form action="{{url('brand/add_do')}}" method="post"> -->
        @csrf
        分类名称: <input type="text" name="cate_name" value="{{$goodsInfo->cate_name}}"><br>
        是否展示: @if($goodsInfo->cate_show==1)
                    <input type="radio" name="cate_show" value="1" checked>是
                    <input type="radio" name="cate_show" value="2">否<br>
                 @else
                    <input type="radio" name="cate_show" value="1">是
                    <input type="radio" name="cate_show" value="2" checked>否<br>
                 @endif
        是否在导航栏展示:@if($goodsInfo->cate_nav_show==1)
                            <input type="radio" name="cate_nav_show" value="1" checked>是
                            <input type="radio" name="cate_nav_show" value="2">否<br>
                        @else
                            <input type="radio" name="cate_nav_show" value="1">是
                            <input type="radio" name="cate_nav_show" value="2" checked>否<br>
                        @endif


        父类: <select name="parent_id">
                    @foreach ($cateInfo as $v)
                        @if($goodsInfo->parent_id==$v->cate_id)
                            <option value="{{$v->cate_id}}" selected>{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
                        @else
                            <option value="{{$v->cate_id}}">{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
                        @endif
                    @endforeach
                </select><br>
        <input type="submit" value="提交" id="submit">
    </form>
</body>

</html>
