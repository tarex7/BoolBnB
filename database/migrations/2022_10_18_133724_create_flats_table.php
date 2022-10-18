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
            $table->unsignedTinyInteger('room_number')->required();
            $table->unsignedTinyInteger('bed_number')->required();
            $table->unsignedTinyInteger('bathroom_number')->required();
            $table->unsignedSmallInteger('square_mt')->required();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->unsignedFloat('price_per_day', 6, 2);
            $table->string('address');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 10, 7);
            $table->boolean('visible');
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
