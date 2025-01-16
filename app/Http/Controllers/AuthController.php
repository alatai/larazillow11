<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

// 以资源为中心的控制器
// 资源是经过身份验证的用户session
class AuthController extends Controller
{
    public function create()
    {
        return inertia('Auth/Login');
    }

    public function store(Request $request)
    {
        // attempt接收两个参数，返回true或false
        // 第一个是凭证，它是一个数组，接受电子邮件和密码
        // Laravel将使用两者来尝试找到具有此类电子邮件的用户
        // 第二个是一个标志：remember me
        // 通常情况下，网页提供一个“记住我”的功能，它使用浏览器cookie确保用户没有注销
        // 并在较长时间或无限期地保持身份验证
        // 在Laravel中，也是使用cookie实现
        if (!Auth::attempt($request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]), true)) {
            // 有一个消息调用的静态初始化方法
            // 抛出异常时将在此时停止执行，并且使用与请求验证完全相同的机制
            // 将所有错误消息传播到前端
            throw ValidationException::withMessages([
                'email' => 'Authentication failed',
            ]);
        }

        // 若通过验证则必须重新生成session
        // 出于安全原因，必须重新生成session，以避免会话固定攻击（Session Fixation Attack）
        $request->session()->regenerate();

        // 将用户重定向到最初将其重定向到登录页面的页面
        // return redirect()->intended();

        // 重定向到指定页面
        return redirect()->intended("/listing");
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        // session无效化
        // 当进行身份验证时，会重新生成session
        $request->session()->invalidate();
        // 重新生成令牌
        $request->session()->regenerateToken();

        return redirect()->route('listing.index');
    }
}
