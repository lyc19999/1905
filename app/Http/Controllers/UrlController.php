<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use App\Wang;
use Illuminate\Validation\Rule;
use Validator;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=request()->post();
        $where=[];
        if(isset($query['w_name'])){
            $where[]=['w_name','like',"%".$query['w_name']."%"];
        }
        $data=Wang::where($where)->paginate(2);
        return view('url.index',['data'=>$data],['query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('url.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->except('_token');

        $validatedData = $request->validate([
            'w_name' => 'required|alpha_dash|unique:wang',
            'w_url'=>'required',
        ],[
            'w_name.required'=>'网站名称必填',
            'w_name.alpha_dash'=>'网站称必须是中文 字母 数字 下划线',
            'w_name.unique'=>'网站名称不能一致',
            'w_url.required'=>'网站网址必填',
        ]);

        if(request()->hasFile('w_logo')){
            $data['w_logo']=$this->upload('w_logo');
        }

        $res=Wang::create($data);
        if($res){
            return redirect('url/index');
        }
    }

    public function upload($file){
        if (request()->file($file)->isValid()) {
            $photo = request()->file($file);
            $store_result = $photo->store('photo');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
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

    public function name_do(){
        $w_name=request()->name;
        $w_id=request()->w_id;
        if($w_name){
            $where[]=['w_name','=',$w_name];
        }
        if($w_id){
            $where[]=['w_id','=',$w_id];
        }
        $where['w_id']=$w_id;
        $res=Wang::where($where)->count();
        echo $res;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data=Wang::find($id);
        return view('url.update',['data'=>$data]);
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
        $validatedData = $request->validate([
            'w_name' => [
                'required',
                'alpha_dash',
                Rule::unique('Wang')->ignore($id,'w_id'),
            ],
            'w_url'=>'required',
        ],[
            'w_name.required'=>'网站名称必填',
            'w_name.alpha_dash'=>'网站称必须是中文 字母 数字 下划线',
            'w_name.unique'=>'网站名称不能一致',
            'w_url.required'=>'网站网址必填',
        ]);
        $data=$request->except('_token');
        if(request()->hasFile('w_logo')){
            $data['w_logo']=$this->upload('w_logo');
        }

        $res=Wang::where('w_id',$id)->update($data);
        if($res){
            return redirect('url/index');
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
        $res=Wang::destroy($id);
        if($res){
            return redirect('url/index');
        }
    }
}
