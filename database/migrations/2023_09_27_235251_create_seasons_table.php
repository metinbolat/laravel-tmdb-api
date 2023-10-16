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
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->string('tmdb_id')->unique();
            $table->unsignedBigInteger('tv_show_id');
            $table->foreign('tv_show_id')->references('id')->on('tv_shows')->onDelete('cascade');
            $table->string('name');
            $table->string('season_number');
            $table->string('episodes_count');
            $table->string('air_date');
            $table->string('status');
            $table->boolean('is_public')->default(0);
            $table->string('poster_path')->nullable();
            $table->text('overview');
            $table->text('meta')->nullable();
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
        Schema::dropIfExists('seasons');
    }
};
