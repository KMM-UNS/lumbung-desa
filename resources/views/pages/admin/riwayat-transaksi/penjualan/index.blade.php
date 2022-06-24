@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Riwayat Penjualan')

@push('css')
<link href="/assets/plugins/morris.js/morris.css" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">Riwayat Penjualan</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">@yield('title')</h1>
<!-- end page-header -->
<!-- begin row -->
<div class="row">
  <!-- begin col-6 -->
  <div class="col-xl-12">
    <!-- begin panel -->
    <div class="panel panel-inverse" data-sortable-id="table-basic-7" style="">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Riwayat Transaksi <span class="label label-success m-l-5 t-minus-1">Pembelian</span></h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <!-- end panel-heading -->
        <!-- begin panel-body -->
        <div class="panel-body">
            <!-- begin table-responsive -->
            <div class="table-responsive">
                <table class="table table-striped m-b-0">
                    <thead>
                        <tr class="text-center">
                            <th>No Penjualan</th>
                            <th>Tgl Penjualan</th>
                            <th>Nama Pembeli</th>
                            <th>Email</th>
                            <th>No Hp</th>
                            <th>Alamat</th>
                            <th>Produk</th>
                            <th>Kondisi</th>
                            <th>Keterangan</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Action</th>
                            {{-- <th width="1%"></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $datas)
                        <tr>
                            {{-- nomornya belum --}}

                            <td>{{ $datas->no_penjualan }}</td>
                            <td>{{ $datas->tgl_penjualan }}</td>
                            <td>{{ $datas->nama }}</td>
                            <td>{{ $datas->email }}</td>
                            <td>{{ $datas->no_hp }}</td>
                            <td>{{ $datas->alamat }}</td>
                            <td>{{ $datas->prpoduk }}</td>
                            <td>{{ $datas->kondisi }}</td>
                            <td>{{ $datas->keterangan }}</td>
                            <td>{{ $datas->harga }}</td>
                            <td>{{ $datas->jumlah }}</td>
                            <td>{{ $datas->total }}</td>
                            <td class="with-btn" nowrap="">
                                {{-- Masih Eror Route --}}
                                <a href="#" class="btn btn-info buttons-primary width-60 m-r-2">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- end table-responsive -->
        </div>
        <!-- end panel-body -->
    </div>
    <!-- end panel -->
  </div>
  <!-- end col-6 -->
</div>
<!-- end row -->
@endsection


@push('scripts')
<script src="/assets/plugins/raphael/raphael.min.js"></script>
<script src="/assets/plugins/morris.js/morris.min.js"></script>
<script src="/assets/js/demo/chart-morris.demo.js"></script>
@endpush
