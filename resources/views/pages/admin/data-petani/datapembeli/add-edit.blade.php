@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Tambah Data Pembeli' : 'Tambah Data Pembeli' )

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">Pendataan</a></li>
  <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Pendataan<small> @yield('title')</small></h1>
<!-- end page-header -->


<!-- begin panel //enctype="multipart/form-data"  -->
<form action="{{  isset($data) ? route('admin.data-petani.datapembeli.update', $data->id) :
route('admin.data-petani.datapembeli.store')  }}"  id="form" name="form" method="POST"
enctype="multipart/form-data" data-parsley-validate="true">
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
        <label for="name">Nama</label>
        <input type="text" id="nama" name="nama" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->nama ?? old('nama') }}}">
        {{-- <label for="name">Jenis Kelamin</label>
    </div>
    <div class="col-md-3">
        <x-form.genderRadio name="jenis_kelamin" selected="{{{ old('jenis_kelamin') ?? ($data['jenis_kelamin'] ?? null) }}}"/>
        {{-- <input type="text" id="jenis_kelamin" name="jenis_kelamin" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->jenis_kelamin ?? old('jenis_kelamin') }}}">
    </div> --}}
    <label for="name">Instansi</label>
    <input type="text" id="instansi" name="instansi" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->instansi ?? old('instansi') }}}">
      <label for="name">Email</label>
        <input type="text" id="email" name="email" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->email ?? old('email') }}}">
        <label for="name">Nomor Telepon</label>
        <input type="number" id="no_hp" name="no_hp" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->no_hp ?? old('no_hp') }}}">
        <label for="name">Alamat</label>
        <input type="text" id="alamat" name="alamat" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->alamat ?? old('alamat') }}}">
       {{-- <label for="name">Foto</label>
        <input type="text" id="foto" name="foto" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->foto ?? old('foto') }}}"> --}}

       {{-- <label for="image">Foto</label>
        <input type="file" id='foto' name="foto" class="form-control" @error('foto') is-invalid @enderror>
        @error('image')
        <div class="invalid-feedback">
            {{$message}} </div>
            @enderror --}}
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
