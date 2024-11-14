<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('hotel_id')->after('id'); // Add the hotel_id column
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->string('end_time')->after('time'); // Add the end_time column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['hotel_id']);
            $table->dropColumn('hotel_id');
            $table->dropColumn('end_time');
        });
    }
};
