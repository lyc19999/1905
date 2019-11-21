<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;
use App\Admin;
use Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=request()->post();
        $where=[];
        if(isset($query['admin_name'])){
            $where[]=['admin_name','like',"%".$query['admin_name']."%"];
        }
        if(isset($query['keys'])){
            $where[]=[$query['keys'],'=',$query['keyval']];
        }
        $pageSize=config('app.pageSize');


        $data=admin::where($where)->paginate($pageSize);


        return view('admin.index',['data'=>$data],['query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *添加视图
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
//    public function store(StoreBlogPost $request)
    {
        //第一种
        $this->validate($request, [
            'admin_name' => 'required|alpha_dash|between:2,12|unique:admin',
            'admin_pwd' => 'required|alpha_num|between:6,12',
            'admin_tel'=>'required|between:11,11',
            'admin_email'=>'required|email',
            'pwd'=>'same:admin_pwd,pwd',
            'admin_head'=>'image'
        ],[
            'admin_name.required'=>'管理员名称必填',
            'admin_name.alpha_dash'=>'管理员名称必须是中文 字母 数字 下划线',
            'admin_name.between'=>'管理员名称必须2-12位',
            'admin_name.unique'=>'管理员名称不能一致',
            'admin_tel.required'=>'手机号必填',
            'admin_tel.between'=>'手机号长度必须为11位',
            'admin_pwd.required'=>'密码必填',
            'admin_pwd.alpha_num'=>'密码必须由字母 数字 下划线组成',
            'admin_pwd.between'=>'密码长度为6-12',
            'admin_email.required'=>'邮箱必填',
            'admin_email.email'=>'邮箱格式不正确',
            'pwd.same'=>'确认密码与密码不一致',
            'admin_head.image'=>'头像必须为图片'
        ]);

        //第三种
//        $validator = Validator::make($request->all(), [
//            'admin_name' => 'required',
//            'admin_pwd' => 'required',
//        ],[
//            'admin_name.required'=>'管理员名称必填',
//            'admin_pwd.required'=>'密码必填'
//        ]);
//        if ($validator->fails()) {
//            return redirect('admin/create')
//                ->withErrors($validator)
//                ->withInput();
//        }

        $data=request()->except('_token');
        if(request()->hasFile('admin_head')){
            $data['admin_head']=$this->upload('admin_head');
        }
        $data['admin_time']=time();
        $res=admin::create($data);
        if($res){
            return redirect('admin/index');
        }
    }

    public function name_do(){
        $admin_name=request()->name;
        $admin_id = request()->admin_id;

        if($admin_name){
            $where[]=['admin_name','=',$admin_name];
        }

        if($admin_id){
            $where[]=['admin_id','=',$admin_id];
        }

        $where['admin_id']=$admin_id;

        $res=admin::where($where)->count();
        echo $res;
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

    /**
     * Show the form for editing the specified resource.
     *修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data=admin::find($id);
        return view('admin.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=request()->except('_token','pwd');
        $this->validate($request, [
            // 'admin_name' => 'required|alpha_dash|between:2,12|unique:admin',
            'admin_name' => [
                'required',
                'alpha_dash',
                'between:2,12',
                Rule::unique('admin')->ignore($id,'admin_id'),
            ],
            'admin_pwd' => 'required|alpha_num|between:6,12',
            'admin_tel' => 'required|between:11,11',
            'admin_email' => 'required|email',
            'pwd' => 'same:admin_pwd,pwd',
            'admin_head' => 'image'
        ], [
            'admin_name.required' => '管理员名称必填',
            'admin_name.alpha_dash' => '管理员名称必须是中文 字母 数字 下划线',
            'admin_name.between' => '管理员名称必须2-12位',
            'admin_name.unique'=>'管理员名称已存在',
            'admin_tel.required' => '手机号必填',
            'admin_tel.between' => '手机号长度必须为11位',
            'admin_pwd.required' => '密码必填',
            'admin_pwd.alpha_num' => '密码必须由字母 数字 下划线组成',
            'admin_pwd.between' => '密码长度为6-12',
            'admin_email.required' => '邮箱必填',
            'admin_email.email' => '邮箱格式不正确',
            'pwd.same' => '确认密码与密码不一致',
            'admin_head.image' => '头像必须为图片'
        ]);

        if (request()->hasFile('admin_head')) {
            $data['admin_head'] = $this->upload('admin_head');
        }
        $data['admin_time'] = time();
        $res=admin::where('admin_id',$id)->update($data);
        if($res){
            return redirect('admin/index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *执行删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=admin::destroy($id);
        if($res){
            return redirect('admin/index');
        }
    }
}
