<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * Policy类名：模型名和Policy后缀
 * Policy 是一种用于管理用户权限的机制，用来定义用户是否有权限执行特定操作
 * 提供了一种结构化的方式，将权限逻辑与控制器或模型分离
 * 从而使代码更加模块化和易于维护
 */
class ListingPolicy
{

    /**
     * 检查用户是否为admin
     * 这个方法会在所有指定的ability方法之前运行
     */
    public function before(User $user, $ability)
    {
        // 还可以指定方法
        if ($user->is_admin /*&& $ability === 'update'*/) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     * ?表示可选参数（nullAble，既没有登录也可以访问对应页面）
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Listing $listing): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Listing $listing): bool
    {
        // 只有创建了listing的人才能修改
        return $user->id === $listing->by_user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Listing $listing): bool
    {
        return $user->id === $listing->by_user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Listing $listing): bool
    {
        return $user->id === $listing->by_user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Listing $listing): bool
    {
        return $user->id === $listing->by_user_id;
    }
}
