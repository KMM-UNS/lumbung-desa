@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Detail Data Pembeli' : 'Create Data Pembeli' )

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
<form action="{{  isset($data) ? route('admin.data-petani.pembeli.update', $data->id) :
route('admin.data-petani.pembeli.store')  }}"  id="form" name="form" method="POST"
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
        {{-- @php $no=0 @endphp --}}
        {{-- @foreach($data as $data)
        {{$data->foto}} --}}


{{-- @foreach($data as $data)
    {{ $data }} --}}

        {{-- @php $no++ @endphp --}}
      <div class="form-group">
       <label for="name">Nama</label>
        <input disabled type="text" id="nama" name="nama" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->nama ?? old('nama') }}}">
        {{-- <label for="name">Jenis Kelamin</label>
    </div>
    <div class="col-md-3">
        <x-form.genderRadio name="jenis_kelamin" selected="{{{ old('jenis_kelamin') ?? ($data['jenis_kelamin'] ?? null) }}}"/>
        {{-- <input type="text" id="jenis_kelamin" name="jenis_kelamin" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->jenis_kelamin ?? old('jenis_kelamin') }}}">
    </div> --}}
    <label for="name">Instansi</label>
    <input disabled type="text" id="instansi" name="instansi" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->instansi ?? old('instansi') }}}">
     <label for="name">Email</label>
        <input disabled type="text" id="email" name="email" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->tempat_lahir ?? old('tempat_lahir') }}}">
        <label for="name">Nomor Handphone</label>
        <input disabled type="number" id="no_hp" name="no_hp" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->tanggal_lahir ?? old('tanggal_lahir') }}}">

        <label for="name">Alamat</label>
        <input disabled type="text" id="alamat" name="alamat" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->alamat ?? old('alamat') }}}">

        {{-- <label for="name">Foto</label> --}}
        {{-- <img src="{{ asset->(auth()->user()->foto)}}" > --}}
 {{-- <img src="{{asset('storage/' . $data)}}" > --}}
 {{-- alt="{{$data->category}}"
 class="img-fluid mt-3" --}}
        {{-- <input disabled type="text" id="foto" name="foto" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->foto ?? old('foto') }}}"> --}}

       {{-- <label for="filename">Foto</label> --}}
        {{-- <input type="file" id='filename' name="filename" class="form-control" autofocus data-parsley-required="true" --}}
        {{-- value="{{{ $data->filename ?? old('filename') }}}"> --}}
      </div>
{{-- @endforeach --}}
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
