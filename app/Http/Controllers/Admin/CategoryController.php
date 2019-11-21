<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Category::paginate(10);
        $cateInfo=Category::showType($data);
        return view('category.index',['cateInfo'=>$cateInfo]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $goodsInfo=Brand::all();
        $cateInfo=Category::showType();
        return view('category.create',['goodsInfo'=>$goodsInfo,'cateInfo'=>$cateInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        $res=Category::create($data);
        if($res){
            return redirect('category/index');
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
        $goodsInfo=Category::find($id);
        $cateInfo=Category::showType();
        return view('category.edit',['goodsInfo'=>$goodsInfo,'cateInfo'=>$cateInfo]);
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
        $res=Category::where('cate_id',$id)->update($data);
        if($res){
            return redirect('category/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cate_id)
    {
        $res=Category::destroy($cate_id);
        if($res){
            return redirect('category/index');
        }
    }
}
