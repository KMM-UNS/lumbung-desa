<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGudangLumbungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gudang_lumbung', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tanaman_id');
            $table->string('stok');
            // $table->string('satuan_id');
            // $table->enum('kondisi', ['Belum Diproses', 'Dikeringkan', 'Digiling']);
            $table->string('kondisi_id');
            $table->string('keterangan_id');
            // $table->softDeletes();
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
        Schema::dropIfExists('gudang_lumbung');
    }
}
