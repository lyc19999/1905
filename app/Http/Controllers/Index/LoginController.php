<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login_do()
    {
        $data = request()->except('_token');
        //        if (Auth::attempt($data)) {
        //            // 认证通过...
        //            return redirect()->intended('/');
        //        }

        if ($data['email']) {
            $where[] = ['email', '=', $data['email']];
        }
        $res = User::where($where)->first();
        if ($res) {
            echo '登陆成功';
            session(['id' => $res['id']]);
            return redirect('/');
        }
    }

    public function reg()
    {
        return view('login.reg');
    }

    public function send()
    {
        $email = request()->email;
        $code = rand(000000, 999999);
        $emailInfo = ['email' => $email, 'code' => $code, 'send_time' => time()];
        session(['emailInfo' => $emailInfo]);
        $this->send_email($email, $code);
    }
    public function send_email($email, $code)
    {
        Mail::send('email', ['name' => $code], function ($message) use ($email) {
            //设置主题
            $message->subject("欢迎注册滕浩有限公司");
            //设置接收方
            $message->to($email);
        });
    }

    public function reg_do(Request $request)
    {
        $data = request()->all();

        //验证
        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'password' => 'required|between:6,12',
        ], [
            'email.required' => '邮箱必填',
            'email.unique' => '邮箱已被注册',
            'password.required' => '密码必填',
            'password.between' => '密码长度为6-12',
        ]);

        //laravel自带密码验证
        $data['password'] = Hash::make($data['password']);

        //取session
        $emailInfo = session('emailInfo');

        if ($data['email'] != $emailInfo['email']) {
            echo '输入的邮箱与将要注册的邮箱不一致';
            die;
        }
        if ($data['code'] != $emailInfo['code']) {
            echo '输入的验证码和将要注册的不一致';
            die;
        }
        if ((time() - $emailInfo['send_time']) > 300) {
            echo '验证码已失效 五分钟内有效';
            die;
        }

        //入库
        $res = User::create($data);
        if ($res) {
            return redirect('/login');
        }
    }

    public function test()
    { }
}
