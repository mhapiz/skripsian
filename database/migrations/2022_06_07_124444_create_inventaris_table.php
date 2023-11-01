<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_aset', function (Blueprint $table) {
            $table->id('id');
            $table->text('foto_path');
            $table->string('kode');
            $table->string('nama');
            $table->string('merk');
            $table->integer('harga');

            $table->text('keterangan')->nullable();

            $table->string('jenis')->default('aset'); // aset, kendaraan;

            $table->string('no_bpkb')->nullable();
            $table->string('no_polisi')->nullable();
            $table->string('no_rangka')->nullable();
            $table->string('no_mesin')->nullable();
            // $table->unsignedInteger('barang_id');
            $table->bigInteger('register');
            $table->string('kondisi');
            $table->string('tahun_masuk');
            $table->string('jenis_kepemilikan')->nullable();
            $table->unsignedInteger('ruangan_id')->nullable();
            $table->unsignedInteger('pegawai_id')->nullable();
            $table->integer('print')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_aset');
    }
};
