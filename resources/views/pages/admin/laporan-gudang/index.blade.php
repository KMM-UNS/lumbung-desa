@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Laporan Gudang Produk')

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
        <li class="breadcrumb-item active">@yield('title')</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">@yield('title')</h1>
    <!-- end page-header -->


    <!-- begin panel -->
    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">Tabel Data - @yield('title')</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
            </div>
        </div>
        <!-- end panel-heading -->
        <!-- begin panel-body -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-xl-12">
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="table-basic-7" style="">
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <!-- begin table-responsive -->
                        <div class="table-responsive">
                            <table class="table table-striped m-b-1">
                                <thead>
                                    <tr class="">
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Stok (kg)</th>
                                        <!-- <th width="1%"></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produkWithStok as $produk => $stok)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $produk }}</td>
                                            <td>{{ $stok }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end table-responsive -->
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-6 -->
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
