<?php

namespace App\Charts;

use App\Models\Pembelian;
use App\Models\PerkiraanPembelian;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class JumlahPetaniPenjualChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $musimPanen = PerkiraanPembelian::get();
        $jumlahPetani = Pembelian::where('musim_id', $musimPanen)->get();
        // dd($jumlahPetani);
        // membuat array baru []
        $musim = array();
        $harga = array();
        $produk = array();
        foreach($jumlahPetani as $jumlahPetanis)
        {
            $x = $jumlahPetanis['harga'];
            $y = $jumlahPetanis['tanaman_id'];
            $z = $jumlahPetanis['musim_id'];
            // dd($x);
            array_push($harga, $x);
            array_push($produk, $y);
            array_push($musim, $z);
        }
        return $this->chart->areaChart()
            ->setTitle('Sales during 2021.')
            ->setSubtitle('Physical sales vs Digital sales.')
            ->addData('harga', [$x])
            ->addData('tanaman_id', [$y])
            ->setXAxis([$z]);
    }
}
