<?php

namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use DemeterChain\B;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Goods as g;
use DB;

class Goods extends Controller{
    public function index(){
       // Cache::flush();
        $page=request()->page;
        $data=cache('index'.$page);
        if(!$data){
            echo '走DB';
            $data=g::paginate(2);
            cache(['index'.$page=>$data],30*24*60);
        }
        return view('index',['data'=>$data]);
    }

    public function xq($id){

        $data=cache('xq'.$id);
        if(!$data){
            echo '走DB';
            $data=g::where('goods_id',$id)->get();
            cache(['xq'.$id=>$data],30*24*60);
        }
        return view('xq',['data'=>$data]);
    }
}
