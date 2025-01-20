<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * AppServiceProvider 是一个服务提供者（Service Provider）
 * 是框架的核心概念之一，用于注册应用的服务或执行启动逻辑
 * AppServiceProvider 位于 app/Providers 目录下
 * 默认是随 Laravel 应用生成的
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
