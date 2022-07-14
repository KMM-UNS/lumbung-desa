@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Detail Penjualan Produk' : 'Create Penjualan Produk' )

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">Master Data</a></li>
  <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Master Data<small> @yield('title')</small></h1>
<!-- end page-header -->


<!-- begin panel -->
<form action="{{ isset($data) ? route('admin.penjualan.penjualanppk.update', $data->id) : route('admin.penjualan.penjualanppk.store') }}" id="form" name="form" method="POST" data-parsley-validate="true">
  @csrf
  @if(isset($data))
  {{ method_field('PUT') }}
  @endif

  <div class="panel panel-inverse">
    <!-- begin panel-heading -->
    <div class="panel-heading">
      <h4 class="panel-title">Form @yield('title')</h4>
      <div class="panel-heading-btn">
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
      </div>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
    <div class="panel-body">
      <div class="form-group">
        <label for="name">Nomor Penjualan</label>
        <input disabled class="form-control" value="{{{ $data->no_penjualan ?? old('no_penjualan') }}}">
        <label for="name">Tanggal Penjualan</label>
        <input disabled class="form-control" value="{{{ $data->tgl_penjualan ?? old('tgl_penjualan') }}}">
        <label for="name">Nama Pembeli</label>
        <input disabled class="form-control" value="{{{ $data->pembelippk->nama ?? old('namapembelippk') }}}">
        <label for="name">Email</label>
        <input disabled type="text" id="email" name="email" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->email ?? old('email') }}}">
        <label for="name">Nomor Handphone</label>
        <input disabled type="text" id="no_hp" name="no_hp" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->no_hp ?? old('no_hp') }}}">
        <label for="name">Alamat</label>
        <input disabled type="text" id="alamat" name="alamat" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->alamat ?? old('alamat') }}}">
        <label for="name">Produk</label>
        <input disabled type="text" id="produk_id" name="produk_id" class="form-control" value="{{{ $data->produkppk->ppk->nama ?? old('produk_id') }}}">
        {{-- <label for="name">Kondisi</label>
        <input disabled class="form-control" id="kondisi_pr" value="{{{ $data->kondisi->kondisi->nama?? old('kondisi_pr') }}}">
        <label for="name">Keterangan</label>
        <input disabled class="form-control" id="keterangan_pr" value="{{{ $data->keterangan->keterangangudang->nama ?? old('keterangan_pr') }}}"> --}}
        <label for="name">Jumlah Penjualan</label>
        <input disabled class="form-control" value="{{{ $data->jumlah ?? old('jumlah') }}}">
        <label for="name">Harga</label>
        <input disabled class="form-control" value="{{{ $data->harga ?? old('harga') }}}">
        <label for="name">Total</label>
        <input disabled type="text" id="total" name="total" class="form-control" value="{{{ $data->total ?? old('total') }}}">
      </div>
    </div>
    <!-- end panel-body -->
    <!-- begin panel-footer -->
    <div class="panel-footer">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <button type="reset" class="btn btn-default">Reset</button>
    </div>
    <!-- end panel-footer -->
  </div>
  <!-- end panel -->
</form>
<a href="javascript:history.back(-1);" class="btn btn-success">
  <i class="fa fa-arrow-circle-left"></i> Kembali
</a>

@endsection

@push('scripts')
<script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
@endpush
