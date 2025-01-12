<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // schema类的table静态方法会对 listings 表进行处理
        // 回调函数获取blueprint类型的参数，其中的方法可以帮助更改数据库
        Schema::table('listings', function (Blueprint $table) {
            // 想添加一些列，可以使用这个对象的一些方法
            $table->unsignedTinyInteger('beds');
            $table->unsignedTinyInteger('baths');
            $table->unsignedSmallInteger('area');

            $table->tinyText('city');
            $table->tinyText('code');
            $table->tinyText('street');
            $table->tinyText('street_nr');

            $table->unsignedInteger('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('listings', function (Blueprint $table) {
        // $table->dropColumn('beds');
        // });

        Schema::dropColumns('listings', [
            'beds',
            'baths',
            'area',
            'city',
            'code',
            'street',
            'street_nr',
            'price'
        ]);
    }
};
