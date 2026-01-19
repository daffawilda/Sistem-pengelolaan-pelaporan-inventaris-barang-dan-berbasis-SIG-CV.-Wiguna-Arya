<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tools', function (Blueprint $table) {
            // Change stock column to unsigned integer (tidak bisa negatif)
            $table->unsignedInteger('stock')->change();
        });
    }

    public function down()
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->integer('stock')->change();
        });
    }
};
