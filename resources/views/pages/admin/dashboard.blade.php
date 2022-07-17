@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Dashboard')

@push('css')
<link href="/assets/plugins/morris.js/morris.css" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">Chart</a></li>
  <li class="breadcrumb-item active">Morris Chart</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Dashboard Admin </h1>
<!-- end page-header -->
<!-- begin row -->
<div class="row">
    <!-- begin col-3 -->
    <div class="col-lg-3 col-md-6">
        <div class="widget widget-stats bg-purple">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">TOTAL PRODUK GUDANG LUMBUNG</div>
                <div class="stats-number">{{ $total_produk }}</div>
                {{-- <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 70.1%;"></div>
                </div>
                <div class="stats-desc">Better than last week (70.1%)</div> --}}
            </div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-3 -->
    <div class="col-lg-3 col-md-6">
        <div class="widget widget-stats bg-grey-darker">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">TOTAL PUPUK GUDANG LUMBUNG</div>
                <div class="stats-number">{{ $total_pupuk }}</div>
                {{-- <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 76.3%;"></div>
                </div>
                <div class="stats-desc">Better than last week (76.3%)</div> --}}
            </div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-3 -->
    <div class="col-lg-3 col-md-6">
        <div class="widget widget-stats bg-purple">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">TOTAL PEMBELIAN PRODUK</div>
                <div class="stats-number">180,200</div>
                {{-- <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 40.5%;"></div>
                </div>
                <div class="stats-desc">Better than last week (40.5%)</div> --}}
            </div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-3 -->
    <div class="col-lg-3 col-md-6">
        <div class="widget widget-stats bg-grey-darker">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">TOTAL PEMBELIAN PUPUK</div>
                <div class="stats-number">3,988</div>
                {{-- <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 54.9%;"></div>
                </div>
                <div class="stats-desc">Better than last week (54.9%)</div> --}}
            </div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-6 -->
    <div class="col-lg-6 col-md-6">
        <div class="widget widget-stats bg-red-darker">
            <div class="stats-icon"><i class="fa fa-desktop"></i></div>
            <div class="stats-info">
                <h4>TOTAL PENGELUARAN PEMBELIAN</h4>
                <p>3,291,922</p>
            </div>
            <div class="stats-link">
                <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
            </div>
        </div>
    </div>
    <!-- end col-6 -->
    <!-- begin col-6 -->
    <div class="col-lg-6 col-md-6">
        <div class="widget widget-stats bg-green-darker">
            <div class="stats-icon"><i class="fa fa-desktop"></i></div>
            <div class="stats-info">
                <h4>TOTAL PEMASUKAN PENJUALAN</h4>
                <p>3,291,922</p>
            </div>
            <div class="stats-link">
                <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
            </div>
        </div>
    </div>
    <!-- end col-6 -->
    <!-- begin grafik perbandingan harga -->
    <div class="col-md-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">GRAFIK HARGA PEMBELIAN PRODUK PER MUSIM</h4>
            </div>
            <div class="panel-body">
                    <div class="bg-white">
                        {!! $perbandinganHargaChart->container() !!}
                    </div>
            </div>
        </div>
    </div>
    <!-- end grafik perbandingan harga -->
    <!-- begin grafik jumlah petani penjual tiap musim -->
    <div class="col-md-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">GRAFIK JUMLAH PETANI PENJUAL TIAP MUSIM</h4>
            </div>
            <div class="panel-body">
                <div class="container px-4 mx-auto">
                    <div class="p-6 m-20 bg-white rounded shadow">
                        {!! $perbandinganHargaChart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end grafik jumlah petani penjual tiap musim -->
<!-- end row -->
</div>
@endsection


@push('scripts')
<script src="/assets/plugins/raphael/raphael.min.js"></script>
<script src="/assets/plugins/morris.js/morris.min.js"></script>
<script src="/assets/js/demo/chart-morris.demo.js"></script>
<script src="{{ $perbandinganHargaChart->cdn() }}"></script>

{{ $perbandinganHargaChart->script() }}
@endpush
