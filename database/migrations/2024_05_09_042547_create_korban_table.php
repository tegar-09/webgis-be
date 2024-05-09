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
        Schema::create('tb_korban', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kejadian');
            $table->integer('hilang')->nullable();
            $table->integer('terluka')->nullable();
            $table->integer('meninggal')->nullable();
            $table->timestamps();

            // Menambahkan kunci asing (foreign key) ke kolom 'id_kejadian'
            $table->foreign('id_kejadian')->references('id')->on('tb_kejadian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_korban');
    }
};