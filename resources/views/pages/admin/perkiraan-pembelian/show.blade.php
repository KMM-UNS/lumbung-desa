@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Detail Data Perkiraan Pembelian' )

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">Pembelian</a></li>
  <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Master Data<small> @yield('title')</small></h1>
<!-- end page-header -->


<!-- begin panel -->
<form action="{{ isset($data) ? route('admin.pembelian.perkiraan-pembelian.update', $data->id) : route('admin.pembelian.perkiraan-pembelian.store') }}" id="form" name="form" method="POST" data-parsley-validate="true">
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
                    <label for="name"><strong>Musim</strong></label>
                </div>
                <div class="col-md-11">
                    <td>: {{ $data->musim->nama }}</td>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Petani</strong></label>
                </div>
                <div class="col-md-5">
                    <td>: {{ $data->petani_id }}</td>
                </div>
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Tanaman</strong></label>
                </div>
                <div class="col-md-5">
                    <td>: {{ $data->tanaman->nama }}</td>
                </div>
            </div>
          </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Lahan</strong></label>
                </div>
                <div class="col-md-5">
                    <td>: {{ $data->lahan_id }}</td>
                </div>
                <div class="col-md-1">
                    <label for="name"><strong>Luas Tanam</strong></label>
                </div>
                <div class="col-md-5">
                    <td>: {{ $data->luas_lahan }}</td>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Jumlah Pembelian</strong></label>
                </div>
                <div class="col-md-4">
                    <td>: {{ $data->jumlah }}</td>
                </div>
                <div class="col-md-1">
                    <td>{{$data->satuan->satuan }}</td>
                </div>
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Kondisi</strong></label>
                </div>
                <div class="col-md-5">
                    <td>: {{ $data->kondisi->nama }}</td>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Harga</strong></label>
                </div>
                <div class="col-md-5">
                    <td>: {{ $data->harga }}</td>
                </div>
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Total</strong></label>
                </div>
                <div class="col-md-5">
                    <td>: {{ $data->total }}</td>
                </div>
            </div>
        </div>
    </div>
    <!-- end panel-body -->
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
