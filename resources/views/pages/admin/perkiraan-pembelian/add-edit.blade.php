@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Data Perkiraan Pembelian' : 'Create Data Perkiraan Pembelian' )

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
<form action="{{ isset($data) ? route('admin.pembelian.perkiraanpembelian.update', $data->id) : route('admin.pembelian.perkiraanpembelian.store') }}" id="form" name="form" method="POST" data-parsley-validate="true">
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
          <label for="name">Musim</label>
          <input type="text" id="musim_id" name="musim_id" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->musim_id ?? old('musim_id') }}}">
        </div>
        <div class="form-group">
          <label for="name">Tanaman</label>
          <input type="text" id="tanaman_id" name="tanaman_id" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->tanaman_id ?? old('tanaman_id') }}}">
        </div>
        <div class="form-group">
          <label for="name">Lahan</label>
          <input type="text" id="no_pembelian" name="no_pembelian" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->no_pembelian ?? old('no_pembelian') }}}">
        </div>
        <div class="form-group">
          <label for="name">Luas Tanam</label>
          <input type="text" id="tanggal_pembelian" name="tanggal_pembelian" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->tanggal_pembelian ?? old('tanggal_pembelian') }}}">
        </div>
        <div class="form-group">
            <label for="name">Kondisi</label>
            <input type="text" id="kondisi" name="kondisi" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->kondisi ?? old('kondisi') }}}">
        </div>
        <div class="form-group">
          <label for="name">Jumlah Pembelian</label>
          <input type="text" id="jumlah" name="jumlah" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->jumlah ?? old('jumlah') }}}">
        </div>
        <div class="form-group">
          <label for="name">Harga</label>
          <input type="text" id="harga" name="harga" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->harga ?? old('harga') }}}">
        </div>
        <div class="form-group">
          <label for="name">Total</label>
          <input type="text" id="total" name="total" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->total ?? old('total') }}}">
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
