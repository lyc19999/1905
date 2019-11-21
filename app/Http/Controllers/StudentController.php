<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class StudentController extends Controller
{
    public function lists(){
        echo '誰tm买小米';
    }

    public function goods($id){
        echo $id;
    }
}
