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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('location'); // alamat proyek
            $table->double('latitude', 10, 7);
            $table->double('longitude', 10, 7);
            $table->enum('status', ['berjalan', 'tertunda', 'selesai'])->default('berjalan');
            $table->foreignId('supervisor_id')->constrained('users'); // mandor
            $table->foreignId('executor_id')->constrained('users');   // pelaksana
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
