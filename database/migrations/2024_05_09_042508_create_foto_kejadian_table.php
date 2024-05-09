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
        Schema::create('tb_foto_kejadian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kejadian');
            $table->string('nama_file');
            $table->text('deskripsi');
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
        Schema::dropIfExists('tb_foto_kejadian');
    }
};
