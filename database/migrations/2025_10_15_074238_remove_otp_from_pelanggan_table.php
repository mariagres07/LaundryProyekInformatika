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
       chema::table('pelanggan', function (Blueprint $table) {
            if (Schema::hasColumn('pelanggan', 'otp')) {
                $table->dropColumn('otp');
            }
        });
    }

    /**
     * Rollback: tambahkan kembali kolom otp jika dibatalkan
     */
    public function down(): void
    {
        Schema::table('pelanggan', function (Blueprint $table) {
            if (!Schema::hasColumn('pelanggan', 'otp')) {
                $table->string('otp')->nullable();
            }
        });
    }
};
