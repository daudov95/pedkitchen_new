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
            $table->text('tab1_title');
            $table->text('tab1_desc');
            $table->text('tab2_title');
            $table->text('tab2_desc');
            $table->text('tab3_title');
            $table->text('tab3_desc');
            $table->text('tab4_title');
            $table->text('tab4_desc');
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
