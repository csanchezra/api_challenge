<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table)
        {
            $table->id();
            $table->tinyInteger('status');
            $table->string('city', 100)->nullable();
            $table->string('lat', 20)->nullable();
            $table->string('long', 20)->nullable();
            $table->tinyInteger('degrees')->nullable();
            $table->string('musical_genre')->nullable();
            $table->text('play_list')->nullable();
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
}
