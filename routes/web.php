<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;

// Laravel 路由
// Route::get('/', function () {
//     // 不适用默认view，而使用inertia 
//     return inertia('Index/Index');
// });

// 将路由指向控制器，可以使用数组，其中第一个元素是类名
// PHP中的每个类都有这个静态常量，包含全限定名
// 第二个元素是方法名
Route::get('/',  [IndexController::class, 'index']);
Route::get('/hello',  [IndexController::class, 'show']);

// 使用路由的另一个方法resource
// 这个resource方法调用将返回一个对象，该对象调用另一个方法(only)
// 该方法接受数组参数，指定需要的Controller方法
Route::resource('listing', ListingController::class);
  // ->only(['index', 'show', 'create', 'store']);
  // ->except(['destroy']);
