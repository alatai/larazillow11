<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 返回一个数组，告诉Laravel模型的每一列的值应该是什么
        return [
            'beds' => fake()->numberBetween(1, 7),
            'baths' => fake()->numberBetween(1, 7),
            'area' => fake()->numberBetween(30, 400),
            'city' => fake()->city(),
            'code' => fake()->postcode(),
            'street' => fake()->streetName(),
            'street_nr' => fake()->numberBetween(10, 200),
            'price' => fake()->numberBetween(50_000, 2_000_000)
        ];
    }
}

/*
   在Laravel中，可以创建模型工厂，定义了如何用假的生成数据填充数据库表
   工厂的目标是用一些数据填充所有模型字段，模型化的字段直接映射到表列
   使用faker方法，自由地提交任何想要的数据

   在Laravel中，如果使用模型名加上工厂作为工厂类名，Laravel会知道这是一个
   列表模型的工厂
   
 */
