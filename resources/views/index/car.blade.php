@extends('layouts.shop')
@section('title','商城首页')

@section('content')
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
        <div class="head-mid">
            <h1>购物车</h1>
        </div>
    </header>
    <div class="head-top">
        <img src="/static/index/images/head.jpg" />
    </div><!--head-top/-->
    <table class="shoucangtab">
        <tr>
            <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
            <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
                <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
            </td>
        </tr>
    </table>
@foreach($cartInfo as $k=>$v)
    <div class="dingdanlist">
        <table>
            <tr>
                <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" id="allBox" /> 全选</a></td>
            </tr>
            <tr goods_id="{{$v->goods_id}}" goods_num="{{$v->goods_num}}" goods_price="{{$v->goods_price}}">
                <td><input type="checkbox" class="box"></td>
                <td class="dingimg" width="15%"><img src="{{$v->goods_img}}" /></td>
                <td width="50%">
                    <h3>{{$v->goods_name}}</h3>
                    <time>下单时间：2015-08-11  13:51</time>
                </td>
                <td align="right">
                    <input type="button" value="-" class="less btn btn-danger" />
                    <input type="text" value="{{$v->buy_number}}" name="" class="car_ipt car" />
                    <input type="button" value="+" class="add btn btn-danger" />
                </td>
            </tr>
            <tr>
                <th colspan="4"><strong class="orange">¥{{$v->goods_price}}</strong></th>
            </tr>
        </table>
    </div><!--dingdanlist/-->
@endforeach
    <div class="height1"></div>
    <div class="gwcpiao">
        <table>
            <tr>
                <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
                <td width="50%">总计：<strong class="orange" id="money">¥0</strong></td>
                <td width="40%"><a href="javascript:;" class="jiesuan" id="confirmSettlement">去结算</a></td>
            </tr>
        </table>
    </div><!--gwcpiao/-->
    <script src="{{asset('/static/index/js/jquery.min.js')}}"></script>
    <script src="{{asset('/static/index/js/jquery.spinner.js')}}"></script>
    <script>
        $('.spinnerExample').spinner({});
    </script>
    <script>
        $( document ).on( 'click', '.add', function ()
        {
            //给文本框的值加1
            var _this = $( this );
            var goods_id = _this.parents( 'tr' ).attr( 'goods_id' );
            var buy_number = parseInt( _this.prev( 'input' ).val() );
            var goods_num = _this.parents( 'tr' ).attr( 'goods_num' );

            if ( buy_number >= goods_num )
            {
                _this.prev( 'input' ).val( buy_number )
            } else
            {
                buy_number += 1;
                _this.prev( 'input' ).val( buy_number )
            }
        } );

        //商品数量-1
        $( document ).on( 'click', '.less', function ()
        {
            //给文本框的值加1
            var _this = $( this );
            var goods_id = _this.parents( 'tr' ).attr( 'goods_id' );
            var buy_number = parseInt( _this.next( 'input' ).val() );
            var goods_num = _this.parents( 'tr' ).attr( 'goods_num' );

            if ( buy_number <= 1 )
            {
                _this.next( 'input' ).val( 1 )
            } else
            {
                buy_number = buy_number - 1;
                _this.next( 'input' ).val( buy_number )
            }

            //数据库中的购买数量为文本框的值
            changeNum( buy_number, goods_id )

            //给当前行选中
            checkedTr( _this );

            //获取小计
            getTotal( _this, goods_id );

            //获取总价
            getCount();
        } );

        $( document ).on( 'blur', '.car', function () {
            var _this = $(this);
            var buy_number = _this.val();
            var goods_id = _this.parents('tr').attr('goods_id');
            var goods_num = _this.parents('tr').attr('goods_num');
            var reg = /^\d+$/;
            if (!reg.test(buy_number) || parseInt(buy_number) <= 0) {
                _this.val(1)
            } else if (parseInt(buy_number) > parseInt(goods_num)) {
                _this.val(goods_num);
                return false;
            } else {
                buy_number = parseInt(buy_number)
                _this.val(buy_number)
            }

            //数据库中的购买数量为文本框的值
            changeNum( buy_number, goods_id )

            //给当前行选中
            checkedTr( _this );

            //获取小计
            getTotal( _this, goods_id );

            //获取总价
            getCount();
        });

        //数据库中的购买数量为文本框的值
        function changeNum( buy_number, goods_id )
        {
            $.ajax( {
                url: "{{url('index/change')}}",
                type: "post",
                data: { buy_number: buy_number, goods_id: goods_id },
                async: true,
            } ).done( function ( res )
            {
                if ( res==2 )
                {
                    alert( res.font )
                }
            } )
        }

        //给当前行选中、复选框选中
        function checkedTr( _this )
        {
            // _this.parents( 'tr' ).addClass( 'car_tr' );
            _this.parents( 'tr' ).find( "input[class='box']" ).prop( 'checked', true );
        }

        //获取小计
        function getTotal( _this, goods_id )
        {
            $.post(
                "{{url('index/total')}}",
                { goods_id: goods_id },
                function ( res )
                {
                    _this.parents( 'tr' ).next( 'tr' ).text( '￥' + res );
                }
            )
        }

        //获取总价
        function getCount()
        {
            //获取复选框的商品id
            var _box = $( ".box:checked" );
            var goods_id = "";
            _box.each( function ( index )
            {
                goods_id += $( this ).parents( "tr" ).attr( 'goods_id' ) + ',';

            } )
            goods_id = goods_id.substr( 0, goods_id.length - 1 )

            //求总价
            $.post(
                "{{url('index/getCount')}}",
                { goods_id: goods_id },
                function ( res )
                {
                    $( '#money' ).text( '￥' + res );
                }
            )
        }

        //点击复选框
        $( document ).on( 'click', '.box', function ()
        {
            //$( this ).parents( 'tr' ).addClass( 'car_tr' );
            getCount();
        } );

        //点击全选
        $( document ).on( 'click', '#allBox', function ()
        {
            var status = $( "#allBox" ).prop( 'checked' );
            $( '.box' ).prop( 'checked', status );
            getCount();
        } );

        //点击结算
        $( document ).on( 'click', '#confirmSettlement', function ()
        {
            var _box = $( ".box:checked" );
            var goods_id = "";
            _box.each( function ( index )
            {
                goods_id += $( this ).parents( "tr" ).attr( 'goods_id' ) + ',';
            } );
            goods_id = goods_id.substr( 0, goods_id.length - 1 );
            if ( goods_id == '' )
            {
                alert( '至少选择一件商品' );
                return false;
            }

            location.href = "{{url('index/confirmSettlement')}}?goods_id=" + goods_id;
        } );

    </script>
@endsection

