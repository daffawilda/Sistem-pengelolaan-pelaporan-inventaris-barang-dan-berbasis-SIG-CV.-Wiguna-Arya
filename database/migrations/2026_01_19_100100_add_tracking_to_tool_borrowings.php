<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tool_borrowings', function (Blueprint $table) {
            // Kondisi alat sebelum dipinjam
            $table->enum('condition_before', ['baik', 'rusak', 'perlu_perbaikan'])->nullable()->after('approved_at');

            // Kondisi alat setelah dikembalikan
            $table->enum('condition_after', ['baik', 'rusak', 'perlu_perbaikan'])->nullable()->after('condition_before');

            // Catatan/deskripsi keadaan alat
            $table->text('notes')->nullable()->after('condition_after');

            // User yang menerima pengembalian
            $table->foreignId('received_by')->nullable()->constrained('users')->nullOnDelete()->after('notes');

            // Waktu alat diterima kembali
            $table->timestamp('received_at')->nullable()->after('received_by');
        });
    }

    public function down()
    {
        Schema::table('tool_borrowings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('received_by');
            $table->dropColumn(['condition_before', 'condition_after', 'notes', 'received_at']);
        });
    }
};
