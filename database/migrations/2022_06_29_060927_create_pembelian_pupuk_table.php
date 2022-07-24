<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianPupukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_pupuk', function (Blueprint $table) {
            $table->id();
            $table->string('no_pembelian');
            $table->string('tanggal_pembelian');
            $table->string('penjual_id');
            $table->string('pupuk_id');
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
        Schema::dropIfExists('pembelian_pupuk');
    }
}
