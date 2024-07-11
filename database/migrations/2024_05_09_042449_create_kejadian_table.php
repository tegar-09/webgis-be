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
        Schema::create('tb_kejadian', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_bencana');
            $table->string('nama_kejadian');
            $table->date('tanggal_kejadian');
            $table->time('waktu_kejadian');
            $table->string('alamat_kejadian');
            $table->unsignedBigInteger('id_kecamatan');
            $table->unsignedBigInteger('id_desa');
            $table->string('penyebab_kejadian');
            $table->text('kronologi');
            $table->integer('ketinggian_air');
            $table->double('latitude');
            $table->double('longitude');
            $table->unsignedBigInteger('id_users');
            $table->timestamps();

            // Menambahkan kunci asing (foreign key) ke kolom 'id_kecamatan'
            $table->foreign('id_kecamatan')->references('id')->on('tb_kecamatan');

            // Menambahkan kunci asing (foreign key) ke kolom 'id_desa'
            $table->foreign('id_desa')->references('id')->on('tb_desa');
            
            // Menambahkan kunci asing (foreign key) ke kolom 'id_users'
            $table->foreign('id_users')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_kejadian');
    }
};
