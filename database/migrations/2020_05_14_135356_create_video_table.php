<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artist_id');
            $table->string('video_file_1')->nullable($value = true);
            $table->string('video_file_2')->nullable($value = true);
            $table->string('video_file_3')->nullable($value = true);
            $table->string('video_file_4')->nullable($value = true);
            $table->string('video_file_5')->nullable($value = true);
            $table->string('video_file_6')->nullable($value = true);
            $table->string('video_file_7')->nullable($value = true);
            $table->string('video_file_8')->nullable($value = true);
            $table->string('video_file_9')->nullable($value = true);
            $table->string('video_file_10')->nullable($value = true);
            $table->boolean('status');
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
        Schema::dropIfExists('video');
    }
}
