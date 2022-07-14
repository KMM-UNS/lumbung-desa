<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanPpksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_ppks', function (Blueprint $table) {
            $table->id();
            $table->string('no_penjualan');
            $table->string('tgl_penjualan');
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('produk_id');
            // $table->string('kondisi');
            // $table->string('keterangan');
            $table->string('harga');
            $table->string('jumlah');
           // $table->string('kondisi');
            $table->string('total');
            $table->softDeletes();
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
        Schema::dropIfExists('penjualan_ppks');
    }
}
