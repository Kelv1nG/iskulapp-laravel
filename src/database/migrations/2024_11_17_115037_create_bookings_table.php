<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->string('full_name');
        $table->string('email');
        $table->string('school_name');
        $table->date('booking_date');
        $table->time('booking_time');
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
