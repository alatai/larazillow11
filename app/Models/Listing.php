<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
    // 模型类需要使用HasFactory
    // 之后Laravel可以理解并发现特定模型的工厂
    use HasFactory;

    // 如果想使用Model的create静态方法
    // create方法修改的每一列都需要在Model的 fillable 属性中列出
    protected $fillable = [
        'beds',
        'baths',
        'area',
        'city',
        'code',
        'street',
        'street_nr',
        'price'
    ];

    /**
     * 描述数据之间的关系
     * BelongsTo: 返回特定类的对象
     * 
     */
    public function owner(): BelongsTo
    {
        // 需要调用特定方法，接受两个参数
        // 参数一：相关联的模型
        // 参数二：自定义外键名称
        return $this->belongsTo(
            \App\Models\User::class,
            'by_user_id'
          );
    }
}
