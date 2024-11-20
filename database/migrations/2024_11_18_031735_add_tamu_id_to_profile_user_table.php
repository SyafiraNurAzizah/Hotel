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
        Schema::table('booking_hotel', function (Blueprint $table) {
            $table->foreignId('tamu_id')->nullable()->constrained('tamu')->onDelete('set null')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_hotel', function (Blueprint $table) {
            $table->dropColumn('tamu_id');
        });
    }
};
