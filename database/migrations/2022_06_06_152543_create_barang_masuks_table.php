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
        Schema::create('tb_barang_masuk', function (Blueprint $table) {
            $table->id('id_barang_masuk');
            $table->date('tanggal');
            $table->unsignedInteger('suplier_id');
            $table->double('total_harga')->nullable();
            $table->boolean('addedToInventaris')->default(false);
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
        Schema::dropIfExists('tb_barang_masuk');
    }
};
