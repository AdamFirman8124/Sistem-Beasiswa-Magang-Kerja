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
        Schema::create('data_lombauser', function (Blueprint $table) {
            $table->id('id_datalombauser')->autoIncrement(); 
            $table->string('nama', 255);
            $table->string('serial', 255);
            $table->string('bukti', 255);
            $table->integer('juara');
            $table->integer('status')->default('1');  
            $table->unsignedBigInteger('lomba_id');
            $table->foreign('lomba_id')->references('id')->on('lombas')->onDelete('NO ACTION'); // 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_lombauser');
    }
};