<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->string('title', 30)->required();
            $table->unsignedTinyInteger('room_number')->nullable();
            $table->unsignedTinyInteger('bed_number')->nullable();
            $table->unsignedTinyInteger('bathroom_number')->nullable();
            $table->unsignedSmallInteger('square_mt')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('price_per_day')->nullable();
            $table->string('address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('visible')->nullable();
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
        Schema::dropIfExists('flats');
    }
}
