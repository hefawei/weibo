<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    /**
     * 注册
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * 显示详情
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * 用户注册
     */
    public function store(Request $request)
    {
        //输入信息校验
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        //创建用户
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        Auth::login($user);

        session()->flash('success', '注册信息成功');

        //成功进行跳转
        return redirect()->route('users.show', [$user]);
    }
}
