<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_languages', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('language', 10)->index('language');
            $table->unsignedInteger('page_id')->index('id_pages');
            $table->string('menu', 256)->nullable();
            $table->string('title', 500)->nullable();
            $table->text('shot_content')->nullable();
            $table->longText('content')->nullable();
            $table->string('tag_title', 1255)->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages_languages');
    }
}
