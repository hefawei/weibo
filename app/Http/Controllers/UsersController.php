<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
}
