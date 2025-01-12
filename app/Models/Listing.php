<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
