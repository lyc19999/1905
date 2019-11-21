<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Brand;
use App\Category;
use DB;
use Illuminate\Validation\Rule;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goodsInfo=DB::table('goods')
            ->join('brand', 'goods.brand_id', '=', 'brand.brand_id')
            ->join('category', 'goods.cate_id', '=', 'category.cate_id')
            ->select('goods.*', 'category.cate_name', 'brand.brand_name')
            ->get();

        // dd($goodsInfo);

        return view('/goods/index',['goodsInfo'=>$goodsInfo]);

    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $goodsInfo=Brand::all();
        $cateInfo=Category::showType();
        return view('goods.create',['goodsInfo'=>$goodsInfo,'cateInfo'=>$cateInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data=request()->except(['_token']);
        if(request()->hasFile('goods_img')){
            $data['goods_img']=$this->upload('goods_img');
        }
        $res=Goods::create($data);
        if($res){
            return  redirect('/goods/index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goodsInfo=goods::find($id);
        $brandInfo=Brand::all();
        $cateInfo=Category::showType();
        return view('goods.edit',['brandInfo'=>$brandInfo,'cateInfo'=>$cateInfo,'goodsInfo'=>$goodsInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->except('_token');
        $res=goods::where('goods_id',$id)->update($data);
        if($res){
            return redirect('goods/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=goods::destroy($id);
        if($res){
            return redirect('goods/index');
        }
    }





    //文件上传
    public function upload($file){

        if (request()->file($file)->isValid()) {
            $photo = request()->file($file);
            $store_result = $photo->store('uploads');

            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }
    //验证用户名唯一性
    public function checkname(){
        $name=request()->name;
        $where=[];
        if($name){
            $where[]=['name','=',$name];
        }
        $admin_id=request()->admin_id;
        if($admin_id){
            $where[]=['admin_id','<>',$admin_id];
        }
        $count=Admin::where($where)->count();
        echo $count;
    }
}
