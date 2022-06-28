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
            $table->id('id_aset');
            $table->string('nama_aset');
            $table->string('kode_aset');
            $table->text('keterangan');
            $table->integer('register');
            $table->string('kondisi');
            $table->double('harga_beli');
            $table->string('tahun_masuk');
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
