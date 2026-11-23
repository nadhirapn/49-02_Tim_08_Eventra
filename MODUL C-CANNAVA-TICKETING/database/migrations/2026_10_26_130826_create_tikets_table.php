<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tikets', function (Blueprint $table) {
            $table->id('id_tiket');
            $table->string('tipe_tiket');
            $table->integer('harga');
            $table->integer('kuota');
            $table->text('benefit');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tikets');
    }
};