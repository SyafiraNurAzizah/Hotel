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
        Schema::table('weddings', function (Blueprint $table) {
            $table->string('judul_paket1')->nullable()->after('judul');
            $table->string('judul_paket2')->nullable()->after('judul_paket1');
            $table->string('judul_paket3')->nullable()->after('judul_paket2');

            $table->string('paket1')->nullable()->after('judul_paket3');
            $table->string('paket2')->nullable()->after('paket1');
            $table->string('paket3')->nullable()->after('paket2');

            $table->dropColumn('paket');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
