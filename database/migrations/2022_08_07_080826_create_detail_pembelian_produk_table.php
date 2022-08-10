<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPembelianProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembelian_produk', function (Blueprint $table) {
            $table->id();
            $table->string('pembelian_id');
            $table->string('tanaman_id');
            $table->string('kondisi_id');
            $table->string('jumlah');
            $table->string('harga');
            $table->string('total');
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
        Schema::dropIfExists('detail_pembelian_produk');
    }
}
