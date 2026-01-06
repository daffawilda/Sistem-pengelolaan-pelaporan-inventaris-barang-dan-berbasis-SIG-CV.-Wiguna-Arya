<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tool_borrowings', function (Blueprint $table) {
            // Status peminjaman
            $table->enum('verified', ['pending', 'approved', 'rejected'])->default('pending')->after('return_date');

            // Admin yang menyetujui
            $table->foreignId('approved_by')->nullable()->constrained('users')->after('verified');

            // Waktu persetujuan
            $table->timestamp('approved_at')->nullable()->after('approved_by');
        });
    }

    public function down()
    {
        Schema::table('tool_borrowings', function (Blueprint $table) {
            $table->dropColumn(['verified', 'approved_by', 'approved_at']);
        });
    }
};