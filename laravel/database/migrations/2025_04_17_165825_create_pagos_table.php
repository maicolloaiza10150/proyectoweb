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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('metodo_pago_id');
            $table->unsignedBigInteger('tarjeta_id')->nullable();
            $table->timestamps();
    
            $table->foreign('metodo_pago_id')->references('id')->on('metodo_pagos');
            $table->foreign('tarjeta_id')->references('id')->on('tarjetas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
