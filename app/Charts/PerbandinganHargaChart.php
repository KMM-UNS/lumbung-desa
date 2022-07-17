<?php

namespace App\Charts;

use App\Models\Pembelian;
use App\Models\PerkiraanPembelian;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PerbandinganHargaChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $musimPanen = PerkiraanPembelian::get();
        $dataPembelian = array();
        foreach ($musimPanen as $musimPanens)
        {
            $pembelian = Pembelian::where('musim_id', $musimPanens->id)->get();
            // $dataProduk = Pembelian::where()
            array_push($dataPembelian, $pembelian);
        }
        // $pembelian = Pembelian::findOrFail('id');
        // dd($pembelian);
        // membuat array baru []
        $musim = array();
        $harga = array();
        $produk = array();

        foreach($dataPembelian as $dataPembelians)
        {
            $x = $dataPembelians[$pembelian->harga];
            $y = $dataPembelians[$pembelian->tanaman_id];
            $z = $dataPembelians[$pembelian->musim_id];
            // dd($x);
            array_push($dataPembelian, $x);
            array_push($dataPembelian, $y);
            array_push($dataPembelian, $z);
        }
        // [0 => '6', 1 => 6 ]
        return $this->chart->areaChart()
            // ->setTitle('Pembelian Produk Per Musim.')
            // ->setSubtitle('Pembelian Produk Hasil Panen Petani.')
            ->setFontFamily('Open Sans')
            ->addData('produk', [$produk])
            ->setXAxis([$musim]);
    }
}
