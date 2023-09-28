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
        Schema::create('reply_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('id')->on('contact_forms');
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
        Schema::dropIfExists('reply_contacts');
    }
};
