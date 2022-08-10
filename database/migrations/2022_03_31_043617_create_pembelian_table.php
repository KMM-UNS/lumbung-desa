<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('no_pembelian');
            $table->string('tanggal_pembelian');
            $table->string('musim_id');
            $table->string('petani_id');
            $table->string('subtotal');
            // $table->integer('tanaman_id');
            // $table->string('kondisi_id');
            // $table->integer('jumlah');
            // $table->string('harga');
            // $table->string('total');
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian');
    }
}
