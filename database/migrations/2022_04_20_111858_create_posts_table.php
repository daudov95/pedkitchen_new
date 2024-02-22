<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->integer('menu_id');
            $table->integer('submenu_id');
            $table->integer('category_id');
            $table->text('tab1_title')->nullable();
            $table->text('tab1_desc')->nullable();
            $table->text('tab2_title')->nullable();
            $table->text('tab2_desc')->nullable();
            $table->text('tab3_title')->nullable();
            $table->text('tab3_desc')->nullable();
            $table->text('tab4_title')->nullable();
            $table->text('tab4_desc')->nullable();
            $table->integer('is_video')->default(0);
            $table->string('video')->nullable();
            $table->text('video_desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
