<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $categories = [
            [
                'name'        => '分享',
                'description' => '分享创造，分享发现',
                'is_nav'      => 1,
                'des_key'     => 'share'
            ],
            [
                'name'        => '教程',
                'description' => '学习路线，学习教程等',
                'is_nav'      => 1,
                'des_key'     => 'jiaocheng'
            ],
            [
                'name'        => '问答',
                'description' => '请保持友善，互帮互助',
                'is_nav'      => 1,
                'des_key'     => 'question'
            ],
            [
                'name'        => '公告',
                'description' => '站点公告',
                'is_nav'      => 1,
                'des_key'     => 'article'
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
