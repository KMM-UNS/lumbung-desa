@extends('layouts.user')

@section('title', 'Detail Riwayat Penjualan')

@push('css')
<!-- datatables -->
<link href="{{ asset('/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" />
<!-- end datatables -->
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">Riwayat Penjualan</a></li>
  <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header"> @yield('title')</h1>
<!-- end page-header -->


<!-- begin panel -->
<div class="panel panel-inverse">
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <h4 class="panel-title">Data @yield('title')</h4>
    <div class="panel-heading-btn">
      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
    </div>
  </div>
  <!-- end panel-heading -->
  <!-- end panel-heading -->
  <div class="panel-body">
    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <label for="name"><strong>Nama Petani</strong></label>
            </div>
            <div class="col-md-10">
                <td>: {{ $datapetani->nama }} </td>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="name"><strong>Total Berat Produk </strong></label>
            </div>
            <div class="col-md-10">
                <td>: {{ $totalberatproduk }} kg </td>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="name"><strong>Total Pembelian </strong></label>
            </div>
            <div class="col-md-10">
                <td>: @currency($totalpembelian) </td>
            </div>
        </div>
    </div>
</div>
<!-- begin panel-body -->
  <!-- begin panel-body -->
  <div class="panel-body">
    {{ $dataTable->table() }}
  </div>
  <!-- end panel-body -->
</div>
<!-- end panel -->
@endsection

@push('scripts')
<!-- datatables -->
<script src="{{ asset('assets/js/custom/datatable-assets.js') }}"></script>
{{ $dataTable->scripts() }}
<!-- end datatables -->

<script src="{{ asset('assets/js/custom/delete-with-confirmation.js') }}"></script>
<script>
  $(document).on('delete-with-confirmation.success', function() {
    $('.buttons-reload').trigger('click')
  })
</script>
@endpush



{{-- <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <title>Chart Sample</title> -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
@extends('layouts.user')

@section('title', 'Morris Chart')

@push('css')
	<link href="/assets/plugins/morris.js/morris.css" rel="stylesheet" />
@endpush

@section('content')
<div align="center">
	<h1 class="page-header"><strong>Riwayat Penjualan</strong></h1>
    </div>
	<!-- end page-header -->
	<!-- begin row -->
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"><strong> No </strong></th>
                        <th scope="col"><strong> Nomor Penjualan </strong></th>
                        <th scope="col"><strong> Tanggal </strong></th>
                        <th scope="col"><strong> Petani </strong></th>
                        <th scope="col"><strong> Musim Panen </strong></th>
                        <th scope="col"><strong> Tanaman </strong></th>
                        <th scope="col"><strong> Jumlah </strong></th>
                        <th scope="col"><strong> Kondisi </strong></th>
                        <th scope="col"><strong> Harga </strong></th>
                        <th scope="col"><strong> Total </strong></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayatpenjualan as $riwayatpenjualans)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $riwayatpenjualans->no_pembelian }}</td>
                        <td>{{ $riwayatpenjualans->tanggal_pembelian}}</td>
                        <td>{{ $riwayatpenjualans->petani->nama}}</td>
                        <td>{{ $riwayatpenjualans->musim->musim_panen}}</td>
                        <td>{{ $riwayatpenjualans->tanaman->nama }}</td>
                        <td>{{ $riwayatpenjualans->jumlah }}</td>
                        <td>{{ $riwayatpenjualans->kondisi->nama }}</td>
                        <td>{{ $riwayatpenjualans->harga }}</td>
                        <td>{{ $riwayatpenjualans->total}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
</body>
</html> --}}
