<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use DemeterChain\B;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Mail;
use App\Goods;
use App\Category;
use App\Cart;
use DB;
use App\Order;
use App\OrderGoods;

class IndexController extends Controller
{
    public function index()
    {
        $count = Goods::count();
        $cateInfo = Category::where('parent_id', '0')->get();
        $goodsInfo = Goods::where('brand_id', 3)->get();
        return view('index.index', ['count' => $count, 'cateInfo' => $cateInfo, 'goodsInfo' => $goodsInfo]);
    }

    public function prolist(){
//        $goodsInfo=Goods::get();

        $goodsInfo=Redis::get('prolist');
        $goodsInfo=unserialize($goodsInfo);

        if(!$goodsInfo){
            echo '走Db';
            $goodsInfo=DB::table('goods')->get();

            Redis::set('prolist',serialize($goodsInfo));
        }

        return view('index.prolist',['goodsInfo'=>$goodsInfo]);
    }

    public function proindex($id){
        $cateInfo=Category::get();
        $cateInfo=find($cateInfo,$id);
        $cate_id=implode(',',$cateInfo);
        $cate_id=explode(',',$cate_id);
        $find=Goods::get()->whereIn('cate_id',$cate_id);
        return view('index.proindex',['find'=>$find]);
    }

    public function proinfo($id){
        $goodsInfo=Goods::find($id);
        $goodsInfo['goods_imgs'] = explode('|', $goodsInfo['goods_imgs']);
        return view('index.proinfo',['goodsInfo'=>$goodsInfo]);
    }

    public function car(){
        $where[]=['is_del','=',1];
        $cartInfo=Cart::join('goods','goods.goods_id','=','cart.goods_id')->where($where)->get();
        $count=Cart::where($where)->count();
        return view('index.car',['cartInfo'=>$cartInfo,'count'=>$count]);
    }

    public function car_do(){
        $data=request()->post();
        $data['add_time']=time();
        $data['user_id']=session('id');
        $res=Cart::create($data);
        print_r($res);
    }

    //数据库中的购买数量为文本框的值
    public function change(){
        $goods_id=request()->goods_id;
        $buy_number=request()->buy_number;
        $user_id=session('id');
        $where=[
            ['user_id','=',$user_id],
            ['goods_id','=',$goods_id],
            ['is_del','=',1]
        ];
        $arr=['buy_number'=>$buy_number];
        $res=Cart::where($where)->update($arr);
        if($res){
            echo '';
        }else{
            echo '改变购买数量失败';
        }
        return $res;
    }

    //获取小计-数据库
    public function total(){
        $goods_id=request()->goods_id;
        $user_id=session('id');

        $goodsWhere=[
            ['user_id','=',$user_id],
            ['goods_id','=',$goods_id]
        ];
        $goods_price=Goods::where($goodsWhere)->value('goods_price');
        $cartWhere=[
            ['goods_id','=',$goods_id],
            ['is_del','=',1]
        ];
        $buy_number=Cart::where($cartWhere)->value('buy_number');

        return $goods_price*$buy_number;
    }

    //获取总价
    public function getCount()
    {
        $goods_id = request()->goods_id;
        $goods_id = explode(',', $goods_id);

        $user_id=session('id');

        $where = [
            ['user_id','=',$user_id],
            ['is_del', '=', 1]
        ];
        $info = Cart::select('goods_price', 'buy_number')
            ->join('goods', 'goods.goods_id', '=', 'cart.goods_id')
            ->whereIn('cart.goods_id', $goods_id)
            ->where($where)
            ->get();

        $money = 0;
        foreach ($info as $k => $v) {
            $money += $v['goods_price'] * $v['buy_number'];
        }
        return $money;
    }

    //点击结算
    public function confirmSettlement(){
        $goods_id=request()->goods_id;
        $goods_id = explode(',', $goods_id);
        if(empty($goods_id)){
            echo '请至少选一件商品';die;
        }

        //查询用户id
        $user_id=session('id');
        $where=[
            ['user_id','=',$user_id],
            ['is_del','=',1]
        ];
        $cartInfo=Cart::join('goods','cart.goods_id','=','goods.goods_id')
            ->whereIn('cart.goods_id',$goods_id)
            ->where($where)
            ->get();
//        print_r($cartInfo);die;
        if(empty($cartInfo[0])){
           echo '请至少选一件商品';die;
        }

        $total=0;
        foreach($cartInfo as $k=>$v){
            $total+=$v['goods_price']*$v['buy_number'];
        }

        //查询当前用户的收货地址
//        $address_model=model('Address');
//        $addressInfo=$address_model->getAddressInfo();
//
//        $this->assign('total',$total);
//        $this->assign('addressInfo',$addressInfo);
//        $this->assign('cartInfo',$cartInfo);
//        $this->getNavInfo();
        return view('index.pay',['total'=>$total,'cartInfo'=>$cartInfo]);
    }

    //确认订单
    public function Order(){

        $goods_id=request()->goods_id;
        $goods_id = explode(',', $goods_id);

        if(empty($goods_id)){
            echo '请至少选择一件商品';die;
        }
        //添加订单
        $orderInfo['order_no']=time().rand(100000,999999);
        //订单总额
        $user_id=session('id');
        $where=[
            ['user_id','=',$user_id],
            ['is_del','=',1]
        ];
        $cartInfo=Cart::select('goods_price','buy_number','goods.goods_id','goods_img','goods_name','user_id')
            ->join('goods','cart.goods_id','=','goods.goods_id')
            ->whereIn('goods.goods_id',$goods_id)
            ->where($where)
            ->get();
        $total=0;
        foreach($cartInfo as $k=>$v){
            $total+=$v['goods_price']*$v['buy_number'];
        }
        $orderInfo['order_amount']=$total;
        $orderInfo['user_id']=$user_id;
        $orderInfo['create_time']=time();
        $res1=Order::create($orderInfo);
        $order_id=$res1->order_id;
        if($res1){
           echo json_encode(['font'=>'下单成功','code'=>1,'order_id'=>$order_id]);

        }else{
            echo json_encode(['font'=>'创建订单信息失败','code'=>2]);
        }


    }

    public function payMoney(){
        $order_id=request()->order_id;
        $user_id=session('id');
        $where=[
            ['order_id','=',$order_id,],
            ['user_id','=',$user_id]
        ];
        $data=Order::where($where)->get();
        return view('index.payMoney',['data'=>$data]);
    }

    public function test(){
        dd(session('id'));
    }
}
