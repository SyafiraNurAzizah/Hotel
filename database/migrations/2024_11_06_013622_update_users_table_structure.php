<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname')->nullable()->after('id');
            $table->string('lastname')->nullable()->after('firstname');
            $table->string('email')->unique()->change();
            $table->timestamp('email_verified_at')->nullable()->change();
            $table->string('password')->change();
            $table->string('no_telp')->nullable()->after('password');
            $table->enum('role', ['admin', 'user'])->default('user')->after('no_telp');
            $table->rememberToken()->after('role');
            // Pastikan kolom lain sudah ada atau tambahkan jika perlu
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['firstname', 'lastname', 'no_telp', 'role']);
            // Ubah kembali kolom lainnya sesuai kebutuhan atau kembalikan ke struktur sebelumnya
        });
    }

};
