@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Gudang Lumbung')

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
  <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">@yield('title')</h1>
<!-- end page-header -->


<!-- begin panel -->
<div class="row">
    <div class="col-xl-3 col-md-6">
      <div class="widget widget-stats bg-orange">
        <div class="stats-icon"><i class="fa fa-users"></i></div>
        <div class="stats-info">
          <h4>GUDANG PRODUK</h4>
        </div>
        <div class="stats-link">
          <a href="{{ route('admin.gudang-lumbung.gudang-produk.index') }}">Lihat Gudang <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="widget widget-stats bg-red">
        <div class="stats-icon"><i class="fa fa-users"></i></div>
        <div class="stats-info">
          <h4>GUDANG PUPUK</h4>
        </div>
        <div class="stats-link">
          <a href="{{ route('admin.gudang-lumbung.gudang-pupuk.index') }}">Lihat Gudang <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
      </div>
    </div>
<!-- end panel -->
@endsection
