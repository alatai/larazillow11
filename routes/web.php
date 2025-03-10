<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\UserAccountController;

// Laravel 路由
// Route::get('/', function () {
//     // 不适用默认view，而使用inertia 
//     return inertia('Index/Index');
// });

// 将路由指向控制器，可以使用数组，其中第一个元素是类名
// PHP中的每个类都有这个静态常量，包含全限定名
// 第二个元素是方法名
Route::get('/',  [IndexController::class, 'index']);
Route::get('/hello',  [IndexController::class, 'show'])
  // 任何未经认证的人都不会被允许进入
  // 中间件在控制器之前运行
  // 有一些中间件是默认运行的
  ->middleware('auth');

// 使用路由的另一个方法resource
// 这个resource方法调用将返回一个对象，该对象调用另一个方法(only)
// 该方法接受数组参数，指定需要的Controller方法
Route::resource('listing', ListingController::class)
  ->only(['index', 'show']);
// 如果将中间件添加到整个资源路由中，它将应用于listing控制器中的所有路由
// ->middleware('auth');
// ->only(['index', 'show', 'create', 'store']);
// ->except(['destroy']);

// 无法使用resource方法来配置这些路径
// 因为该方法会为资源控制器创建资源路由
// /login/create
// /login
// /login/{login}
// ...
Route::get('login', [AuthController::class, 'create'])
  ->name('login');
Route::post('login', [AuthController::class, 'store'])
  ->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])
  ->name('logout');

Route::resource('user-account', UserAccountController::class)
  ->only(['create', 'store']);

Route::prefix('realtor')
  ->name('realtor.')
  ->middleware('auth')
  // 只有在这个函数中，才能定义根
  // 在这里定义的所有规则都适用于这个组中定义的所有路由
  ->group(function () {
    // 确保额外的路由定义在资源路由之上（顺序很重要）
    Route::put(
      'listing/{listing}/restore',
      [RealtorListingController::class, 'restore']
    )
      // 把 name('listing.restore') 放在 put() 之后， Laravel 才能正确解析？？
      ->name('listing.restore')
      ->withTrashed();
    Route::resource('listing', RealtorListingController::class)
      ->only(['index', 'destroy', 'edit', 'update', 'create', 'store'])
      ->withTrashed();
  });
