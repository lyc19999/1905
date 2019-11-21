<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function add_do(){

        $data=request()->except('_token');
        if(request()->hasFile('brand_logo')){
            $data['brand_logo']=$this->upload('brand_logo');
        }
        $res=DB::table('brand')->insert($data);
        if($res){
            return redirect('brand/list');
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

    public function lists(){
        $data = DB::table('brand')->get()->toArray();
        if($data){
            return view('brand.list',['data'=>$data]);
        }
    }

    public function edit($id){
        $data = DB::table('brand')->where(['brand_id'=>$id])->first();
        return view('brand.edit',['data'=>$data]);
    }

    public function update($id){
        $data=request()->except('_token');
        if(request()->hasFile('brand_logo')){
            $data['brand_logo']=$this->upload('brand_logo');
        }
        $res=DB::table('brand')->where(['brand_id'=>$id])->update($data);
        if($res){
            return redirect('brand/list');
        }
    }

    public function delete($id){
        $res=DB::table('brand')->where('brand_id',$id)->delete();
        if($res){
            return redirect('brand/list');
        }
    }
}
