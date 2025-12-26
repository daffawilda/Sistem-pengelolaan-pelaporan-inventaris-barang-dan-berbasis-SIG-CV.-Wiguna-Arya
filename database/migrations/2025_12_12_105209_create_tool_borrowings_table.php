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
        Schema::create('tool_borrowings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('tool_id')->constrained()->onDelete('cascade');
            $table->foreignId('borrower_id')->constrained('users'); // mandor/pelaksana
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->date('borrow_date');
            $table->date('return_date')->nullable();
            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_borrowings');
    }
};
