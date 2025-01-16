<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        // dd(Listing::all());

        // 返回文本
        // return "Index";
        
        // dd(Auth::user());

        // 检查是否登录
        // dd(Auth::check());

        // 利用inertia返回vue页面
        // 返回指定路径的页面，默认情况下是resources下的js页面
        return inertia(
            'Index/Index',
            [
                'message' => 'Hello from Laravel!'
            ]
        );
    }


    public function show()
    {
        return inertia('Index/Show');
    }
}
