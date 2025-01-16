<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function create()
    {
        return inertia('UserAccount/Create');
    }

    public function store(Request $request)
    {
        // User::create($request->validate([

        // 所有的Laravel模型中，除了create方法，还有make方法
        // 这将创建用户模型的新实例，但他还不会将此模型存储到数据库中
        $user = User::make($request->validate([
            'name' => 'required',
            // 保持email唯一性
            'email' => 'required|email|unique:users',
            'password' => 'required|:8|confirmed',
        ]));

        // 其他逻辑...

        // 保存到数据库
        $user->save();

        // 可以使用Auth，立即登录创建的用户
        Auth::login($user);

        return redirect()->route('listing.index')
            ->with('success', 'Account created!');
    }
}
