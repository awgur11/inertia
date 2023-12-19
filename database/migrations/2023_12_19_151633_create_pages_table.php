<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();
            $table->text('preview')->nullable();
            $table->string('preview_path', 256)->nullable();
            $table->string('preview_name', 2000)->nullable();
            $table->string('alt_title');
            $table->string('tag_title', 500)->nullable();
            $table->string('description', 2550)->nullable();
            $table->timestamps();
            $table->integer('parent_id')->default(0);
            $table->integer('category_id')->default(0);
            $table->integer('position')->nullable();
            $table->boolean('public')->default(0);
            $table->integer('user_id')->default(1)->index('user');
            $table->boolean('use_in_product')->default(0);
            $table->boolean('menu')->default(0);
            $table->integer('fvalue_id')->nullable()->index('fvalue_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
