<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    // localScope是添加到模型中的方法
    // 它是一个公开函数，名称总是以scope开始
    // 有一个参数，查询生成器
    public function scopeMostRecent(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    // 第一个参数总是查询生成器，之后可以添加额外参数
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        // $condition：布尔值或可评估为布尔值的条件。
        // function ($query, $value)：一个回调函数，当 $condition 为真时会被执行。
        // $value：默认情况下与 $condition 相同。如果 $condition 是闭包，则可以自定义返回的值。
        // $query->when($condition, function ($query, $value)
        return $query->when(
            $filters['priceFrom'] ?? false,
            fn($query, $value) => $query->where('price', '>=', $value)
        )->when(
            $filters['priceTo'] ?? false,
            fn($query, $value) => $query->where('price', '<=', $value)
        )->when(
            $filters['beds'] ?? false,
            fn($query, $value) => $query->where('beds', (int)$value < 6 ? '=' : '>=', $value)
        )->when(
            $filters['baths'] ?? false,
            fn($query, $value) => $query->where('baths', (int)$value < 6 ? '=' : '>=', $value)
        )->when(
            $filters['areaFrom'] ?? false,
            fn($query, $value) => $query->where('area', '>=', $value)
        )->when(
            $filters['areaTo'] ?? false,
            fn($query, $value) => $query->where('area', '<=', $value)
        );
    }
}
