<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likable', function (Blueprint $table) {
            $table->id();
            $table->boolean('like')->default(true);
            $table->unsignedBigInteger('likeable_id');
            $table->string('likeable_type');
            $table->unsignedBigInteger('user_id');
            $table->unique(['likeable_id','likeable_type','user_id']);
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('likes');
    }
}
