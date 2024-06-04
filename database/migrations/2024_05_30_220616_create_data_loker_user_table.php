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
        Schema::create('data_lokeruser', function (Blueprint $table) {
            $table->id('id_datamaganguser')->autoIncrement(); 
            $table->string('nama', 255);
            $table->string('serial', 255);
            $table->string('bukti', 255);// Menggunakan id_datalombauser sebagai kunci primer yang otomatis bertambah
            $table->string('durasi', 255);// Menggunakan id_datalombauser sebagai kunci primer yang otomatis bertambah
            $table->unsignedBigInteger('magang_id'); // Kolom untuk menyimpan ID lomba dari tabel lombas
            $table->foreign('magang_id')->references('id')->on('lokers')->onDelete('NO ACTION'); // Menambahkan foreign key ke tabel lombas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_lokeruser');
    }
};