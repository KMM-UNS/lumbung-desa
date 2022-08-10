@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Detail Pembelian Pupuk')

@push('css')
<link href="/assets/plugins/morris.js/morris.css" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">Pembelian Pupuk</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">@yield('title')</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">@yield('title')</h1>
<!-- end page-header -->

<!-- begin row -->
<div class="panel panel-inverse">
    <!-- begin panel-heading -->
    <div class="panel-heading">
      <h4 class="panel-title">Tabel Data - @yield('title')</h4>
      <div class="panel-heading-btn">
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
      </div>
    </div>
    <!-- end panel-heading -->
    <div class="panel-body">
        @foreach ($pembelian as $item)
        <h3>{{ $item->no_pembelian }}</h3>
        @endforeach
        @if ($data)
        <h5>Subtotal : @currency($data->sum('total'))</h5>
        @endif
    </div>
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
