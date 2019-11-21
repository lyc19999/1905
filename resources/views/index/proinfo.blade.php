@extends('layouts.shop')
@section('title','商城首页')

@section('content')
    <script src="/js/jquery.js"></script>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>产品详情</h1>
        </div>
    </header>
    <div id="sliderA" class="slider">
        @foreach($goodsInfo['goods_imgs'] as $v)
            <img src="{{$v}}" />
        @endforeach
    </div><!--sliderA/-->
    <table class="jia-len">
        <tr>
            <th><strong class="orange">{{$goodsInfo->goods_price}}</strong></th>
            <td>
                <input type="text" class="spinnerExample" />
            </td>
        </tr>
        <tr>
            <td>
                <strong>三级分销农庄有机毛豆500g</strong>
                <p class="hui">富含纤维素，平衡每日膳食</p>
            </td>
            <td align="right">
                <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
            </td>
        </tr>
    </table>
    <div class="height2"></div>
    <h3 class="proTitle">商品规格</h3>
    <ul class="guige">
        <li class="guigeCur"><a href="javascript:;">50ML</a></li>
        <li><a href="javascript:;">100ML</a></li>
        <li><a href="javascript:;">150ML</a></li>
        <li><a href="javascript:;">200ML</a></li>
        <li><a href="javascript:;">300ML</a></li>
        <div class="clearfix"></div>
    </ul><!--guige/-->
    <div class="height2"></div>
    <div class="zhaieq">
        <a href="javascript:;" class="zhaiCur">商品简介</a>
        <a href="javascript:;">商品参数</a>
        <a href="javascript:;" style="background:none;">订购列表</a>
        <div class="clearfix"></div>
    </div><!--zhaieq/-->
    <div class="proinfoList">
        <img src="/static/index/images/image4.jpg" width="636" height="822" />
    </div><!--proinfoList/-->
    <div class="proinfoList">
        暂无信息....
    </div><!--proinfoList/-->
    <div class="proinfoList">
        暂无信息......
    </div><!--proinfoList/-->
    <table class="jrgwc">
        <tr goods_id="{{$goodsInfo->goods_id}}" goods_num="{{$goodsInfo->goods_num}}" goods_price="{{$goodsInfo->goods_price}}">
            <th>
                <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
            </th>
            <td><a href="javascript:;" id="cart" class="btn btn-danger">加入购物车</a></td>
        </tr>
    </table>
<!--jq加减-->
<script src="{{asset('/static/index/js/jquery.min.js')}}"></script>
<script src="{{asset('/static/index/js/jquery.spinner.js')}}"></script>
<script>
    $('.spinnerExample').spinner({});
</script>
    <script>
        $("#cart").click(function(){
            var _this=$(this);
            var goods_id=_this.parents('tr').attr('goods_id');
            var goods_num=_this.parents('tr').attr('goods_num');
            var add_price=_this.parents('tr').attr('goods_price');
            var buy_number=$('.spinnerExample').val();
            $.ajax({
                url:"{{url('index/car_do')}}",
                type:"post",
                data:{goods_id:goods_id,add_price:add_price,buy_number:buy_number},
                async:false,
            }).done(function(res){
                if(!res==''){
                    location.href="{{url('index/car')}}";
                }
            })
        });


    </script>
@endsection



