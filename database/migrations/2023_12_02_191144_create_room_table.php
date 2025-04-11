<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room', function (Blueprint $table) {
            $table->Increments('room_id');
            $table->integer('HotelID');
            $table->string('room_type');
            $table->string('room_Image');
            $table->bigInteger('room_price');
            $table->integer('room_no');
            $table->tinyInteger('room_status')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('room');
    }
};
