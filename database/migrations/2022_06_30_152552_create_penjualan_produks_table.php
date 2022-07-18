<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_produks', function (Blueprint $table) {
            $table->id();
            $table->string('no_penjualan');
            $table->string('tgl_penjualan');
            $table->string('nama_petani');
            // $table->string('email');
            // $table->string('no_hp');
            // $table->string('alamat');
            $table->string('produk_id');
            $table->string('kondisi_pr');
            $table->string('keterangan_pr');
            $table->string('harga');
            $table->string('jumlah');
           // $table->string('kondisi');
            $table->string('total');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan_produks');
    }
}
