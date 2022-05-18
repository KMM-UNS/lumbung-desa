@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Data Kas' : 'Create Data Kas' )

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">KAS</a></li>
  <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">KAS<small> @yield('title')</small></h1>
<!-- end page-header -->


<!-- begin panel -->
<form action="{{ isset($data) ? route('admin.kas.update', $data->id) : route('admin.kas.store') }}" id="form" name="form" method="POST" data-parsley-validate="true">
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
            <div class="row">
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Tanggal</strong></label>
                </div>
                <div class="col-md-11">
                    <input type="date" id="tanggal" name="tanggal" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->tanggal ?? old('tanggal') }}}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Kategori</strong></label>
                </div>
                <div class="col-md-11">
                    <x-form.Dropdown name="kategori_id" :options="$kategorikas" selected="{{{ old('kategori_id') ?? ($data['kategori_id'] ?? null) }}}" required />
                </div>
            </div>
        </div>
      <div class="form-group">
          <div class="row">
              <div class="col-md-1 my-auto">
                  <label for="name"><strong>Keterangan</strong></label>
              </div>
              <div class="col-md-5">
                  <input type="text" id="keterangan" name="keterangan" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->keterangan ?? old('keterangan') }}}">
              </div>
              <div class="col-md-1 my-auto">
                  <label for="name"><strong>Pembayaran</strong></label>
              </div>
              <div class="col-md-5">
                <input type="text" id="pembayaran" name="pembayaran" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->pembayaran ?? old('pembayaran') }}}">
            </div>
          </div>
      </div>
      <div class="form-group">
        <div class="row">
            <div class="col-md-1 my-auto">
                <label for="name"><strong>Jumlah</strong></label>
            </div>
            <div class="col-md-5">
                <input type="text" id="jumlah" name="jumlah" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->jumlah ?? old('jumlah') }}}">
            </div>
            <div class="col-md-1 my-auto">
                <label for="name"><strong>Saldo</strong></label>
            </div>
            <div class="col-md-5">
                <input type="text" id="saldo" name="saldo" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->saldo ?? old('saldo') }}}">
            </div>
        </div>
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
