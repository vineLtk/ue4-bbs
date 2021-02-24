<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration 
{
	public function up()
	{
		Schema::create('topics', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->text('body');
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('reply_count')->default(0)->unsigned();
            $table->integer('view_count')->default(0)->unsigned();
            $table->integer('last_reply_user_id')->default(0)->unsigned();
            $table->integer('sort')->default(0);
            $table->text('excerpt')->nullbale();
            $table->string('slug')->nullable()->comment('SEO友好的URI');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('topics');
	}
}
