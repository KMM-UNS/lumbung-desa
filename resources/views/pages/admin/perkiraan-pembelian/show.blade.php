@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Perkiraan Modal Pembelian')

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
  <li class="breadcrumb-item"><a href="javascript:;">Musim Panen</a></li>
  <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Pembelian<small> @yield('title')</small></h1>
<!-- end page-header -->

<!-- begin panel -->
<div class="panel panel-inverse" data-sortable-id="table-basic-7">
    <div class="panel-heading ui-sortable-handle">
      {{-- <h4 class="panel-title">Perkiraan Modal Pembelian <span class="label label-success m-l-5 t-minus-1">{{ $data->id }}</span></h4> --}}
      <h4 class="panel-title">Perkiraan Modal Pembelian</h4>
      <div class="panel-heading-btn">
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
      </div>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-2 my-auto">
                    <label for="name"><strong>Jumlah Penjual</strong></label>
                </div>
                <div class="col-md-10">
                    <td>: {{ $jumlahpetani }} </td>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-2 my-auto">
                    <label for="name"><strong>Total Produk</strong> (item)</label>
                </div>
                <div class="col-md-10">
                    <td>: {{ $totaljumlahproduk }} </td>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-md-2 my-auto">
                    <label for="name"><strong>Total Berat Produk</strong> (/kg)</label>
                </div>
                <div class="col-md-10">
                    <td>: {{ $totalberatproduk }} kg </td>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 my-auto">
                    <label for="name"><strong>Modal</strong></label>
                </div>
                <div class="col-md-10">
                    <td>: @currency($perkiraanmodal) </td>
                </div>
            </div>
            {{-- <div class="col">
                <a href="{{ route('admin.pembelian.pembelian-modal.cetak') }}" class="button-primary fas fa-print fa-fw">Cetak</a>
            </div> --}}
        </div>
    </div>
</div>

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
  <!-- begin panel-body -->

  <div class="panel-body">
      {{-- {{  $request->segment(4) }} --}}
    <a href="{{ route('admin.pembelian.pembelian-modal.simpan', $id)  }}" class="btn btn-secondary">+   Create</a>
    <p></p>
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
