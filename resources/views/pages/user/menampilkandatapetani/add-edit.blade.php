@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Data Petani' : 'Create Data Petani' )

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


<!-- begin panel //enctype="multipart/form-data"  -->
<form action="{{  isset($data) ? route('user.menampilkandatapetani.update', $data->id) :
route('user.menampilkandatapetani.store')  }}"  id="form" name="form" method="POST"
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
        <div class="row">
            <div class="col-md-1">
                <label for="name">No KK</label>
            </div>
            <div class="col-md-3">
                <input type="text" id="no_kk" name="no_kk" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->no_kk ?? old('no_kk') }}}">
            </div>
            <div class="col-md-1">
                <label for="name">NIK</label>
            </div>
            <div class="col-md-3">
                <input type="text" id="nik" name="nik" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->NIK ?? old('NIK') }}}">
            </div>
            <div class="col-md-1">
                <label for="name">Nama</label>
            </div>
            <div class="col-md-3">
                <input type="text" id="nama" name="nama" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->tempat_lahir ?? old('tempat_lahir') }}}">
            </div>
            <div class="col-md-1">
                <label for="name">Tempat Lahir</label>
            </div>
            <div class="col-md-3">
                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->berat_badan_lahir ?? old('berat_badan_lahir') }}}">
            </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
            <div class="col-md-1">
                <label for="name">Tanggal Lahir</label>
            </div>
            <div class="col-md-3">
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->tanggal_lahir ?? old('tanggal_lahir') }}}">
            </div>

            {{-- <div class="col-md-1">
                <label for="name">Tinggi Badan Lahir</label>
            </div>
            <div class="col-md-3">
                <input type="text" id="tinggi_badan_lahir" name="tinggi_badan_lahir" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->tinggi_badan_lahir ?? old('tinggi_badan_lahir') }}}">
    </div> --}}
    {{-- </div> --}}

        <div class="form-group">
          <div class="row">
              {{-- <div class="col-md-1">
                  <label for="name">Umur</label>
              </div>
              <div class="col-md-3">
                  <input type="text" id="umur" name="umur" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->umur ?? old('umur') }}}">
              </div> --}}
              <div class="col-md-1">
                  <label for="name">Jenis Kelamin</label>
              </div>
              <div class="col-md-3">
                  <x-form.genderRadio name="jenis_kelamin" selected="{{{ old('jenis_kelamin') ?? ($data['jenis_kelamin'] ?? null) }}}"/>
                  {{-- <input type="text" id="jenis_kelamin" name="jenis_kelamin" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->jenis_kelamin ?? old('jenis_kelamin') }}}"> --}}
              </div>
               <div class="col-md-1">
                  <label for="name">Alamat</label>
              </div>
              <div class="col-md-3">
                  <input type="text" id="alamat" name="alamat" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->anak_ke ?? old('anak_ke') }}}">
              </div>
              <div class="col-md-1">
                <label for="name">Foto</label>
            </div>
            <div class="col-md-3">
                <input type="text" id="foto" name="foto" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->anak_ke ?? old('anak_ke') }}}">
            </div>
        </div>
        </div>
        {{-- <div class="form-group">
          <div class="row">
              <div class="col-md-1">
                  <label for="name">Nama Orangtua</label>
              </div>
              <div class="col-md 3">
                  <input type="text" id="nama_orangtua" name="nama_orangtua" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->nama_orangtua ?? old('nama_orangtua') }}}">
              </div>
              <div class="col-md-1">
                  <label for="name">No Handphone Orangtua</label>
              </div>
              <div class="col-md-3">
                  <input type="text" id="no_hp_orangtua" name="no_hp_orangtua" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->no_hp_orangtua ?? old('no_hp_orangtua') }}}">
              </div> --}}
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
