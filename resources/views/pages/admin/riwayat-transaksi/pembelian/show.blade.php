@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Detail Riwayat Pembelian')

@push('css')
<link href="/assets/plugins/morris.js/morris.css" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">Riwayat Pembelian</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">@yield('title')</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">@yield('title')</h1>
<!-- end page-header -->

<!-- begin row -->
{{-- <div class="row">
  <!-- begin col-6 -->
  <div class="col-xl-12">
    <!-- begin panel -->
    <div class="panel panel-inverse" data-sortable-id="table-basic-7" style="">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Riwayat Transaksi <span class="label label-success m-l-5 t-minus-1">Pembelian</span></h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <!-- end panel-heading -->
        <!-- begin panel-body -->
        <div class="panel-body">
            <!-- begin table-responsive -->
            <div class="table-responsive">
                <table class="table table-striped m-b-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Pembelian</th>
                            <th>Tanggal Pembelian</th>
                            <th>Musim</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Kondisi</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th width="1%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $datas)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $datas->no_pembelian }}</td>
                            <td>{{ $datas->tanggal_pembelian }}</td>
                            <td>{{ $datas->musim->nama }}</td>
                            <td>{{ $datas->tanaman->nama }}</td>
                            <td>{{ $datas->jumlah }}</td>
                            <td>{{ $datas->kondisi->nama }}</td>
                            <td>{{ $datas->harga }}</td>
                            <td>{{ $datas->total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- end table-responsive -->
        </div>
        <!-- end panel-body -->
    </div>
    <!-- end panel -->
  </div>
  <!-- end col-6 -->
</div>
<!-- end row -->
@endsection --}}


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
        <div class="form-group">
            <div class="row">
                <div class="col-md-2">
                    <label for="name"><strong>Nama Petani</strong></label>
                </div>
                <div class="col-md-10">
                    <td>: {{ $datapetani->nama }} </td>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <label for="name"><strong>Total Berat Produk </strong></label>
                </div>
                <div class="col-md-10">
                    <td>: {{ $totalberatproduk }} kg </td>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <label for="name"><strong>Total Pembelian </strong></label>
                </div>
                <div class="col-md-10">
                    <td>: @currency($totalpembelian) </td>
                </div>
            </div>
        </div>
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
