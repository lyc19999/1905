<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Validator;

class Login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('login/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin_name = $request->admin_name;
        $admin_pwd = $request->admin_pwd;

        if ($admin_name) {
            $where[] = ['admin_name', '=', $admin_name];
        }

        $validatedData = $request->validate([
            'admin_name' => 'required|exists:admin',
            'admin_pwd' => 'required|exists:admin',


        ], [
            'admin_name.required' => '姓名不能为空',
            'admin_name.exists' => '账号不存在',
            'admin_pwd.required' => '密码不能为空',
            'admin_pwd.exists' => '密码不存在',


        ]);

        $info = admin::where($where)->first();



        if (!empty($info)) {
            if ($admin_pwd == $info['admin_pwd']) {
                session(['user' => $info['admin_name']]);
                return redirect('admin/index');
            }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
