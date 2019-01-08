<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    /**
     * 登录页面
     */
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * 登录认证
     */
    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        //用户认证
        if( Auth::attempt($credentials) ) {
            //登录成功
            session()->flash('success', '欢迎回来!');
            return redirect()->route('users.show', [Auth::user()]);
        } else {
            //登录失败
            session()->flash('danger', '您的邮箱和密码不匹配');
            return redirect()->back();
        }
    }

    /**
     * 退出
     */
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
}
