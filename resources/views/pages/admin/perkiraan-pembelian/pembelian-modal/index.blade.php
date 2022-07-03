@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Data Perkiraan Pembelian')

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
    <li class="breadcrumb-item"><a href="javascript:;">Perkiraan Modal Pembelian</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
    </ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Perkiraan Modal Pembelian<small> @yield('title')</small></h1>
<!-- end page-header -->


<!-- begin panel -->
<div class="panel panel-inverse">
    <!-- begin panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title">DataTable - @yield('title')</h4>
        <div class="panel-heading-btn">
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <!-- end panel-heading -->
<!-- begin panel-body -->
{{-- <div class="panel-body">
    {{ $dataTable->table() }}
</div> --}}

<!-- begin panel-body -->
<div class="panel-body">
    <!-- begin table-responsive -->
    <div class="table-responsive">
        <table class="table table-striped m-b-0">
            <a href="{{ route('admin.pembelian.pembelian-modal.create') }}" class="btn btn-secondary">+   Create</a>
            <br>
            <thead>
                <tr>
                    <th>No</th>
                    {{-- <th><strong> Musim Panen </strong></th> --}}
                    <th><strong> Nama Petani </strong></th>
                    <th><strong> Tanaman </strong></th>
                    <th><strong> Lahan </strong></th>
                    <th><strong> Luas Lahan </strong></th>
                    <th><strong> Jumlah </strong></th>
                    <th><strong> Kondisi </strong></th>
                    <th><strong> Harga </strong></th>
                    <th><strong> Total </strong></th>
                    <th><strong> Action </strong></th>
                    <th width="1%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($modal as $modals)
                <tr>
                    <td></td>
                    {{-- <td>{{ $modals->musim_panen_id }}</td> --}}
                    <td>{{ $modals->petani->nama }}</td>
                    <td>{{ $modals->tanaman->nama }}</td>
                    <td>{{ $modals->lahan->nama }}</td>
                    <td>{{ $modals->luas_lahan }}</td>
                    <td>{{ $modals->jumlah }}</td>
                    <td>{{ $modals->kondisi->nama }}</td>
                    <td>{{ $modals->harga }}</td>
                    <td>{{ $modals->total}}</td>
                    <td class="with-btn" nowrap="">
                        <a href="#" class="btn btn-info buttons-primary width-60 m-r-2">Detail</a>
                        <a href="#" class="btn btn-danger buttons-delete width-60 m-r-2">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- end table-responsive -->
</div>
<!-- end panel-body -->

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
