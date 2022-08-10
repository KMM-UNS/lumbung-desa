@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Laporan Pembelian Produk')

@push('css')
<!-- datatables -->
<link href="{{ asset('/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" />

<!-- end datatables -->
<link href="{{ asset('/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    {{-- <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dasbor</a></li> --}}
    <li class="breadcrumb-item"><a href="javascript:;">home</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header"> @yield('title')</h1>
<!-- end page-header -->


<!-- begin panel -->
<div class="panel panel-inverse">
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <h4 class="panel-title">Data @yield('title')</h4>
    <div class="panel-heading-btn">
      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
    </div>
  </div>
  <!-- end panel-heading -->
  <!-- begin panel-body -->
  <div class="panel-body">
    <div class="container">
        <form action="{{ route('admin.laporan-pembelian.produk') }}" method="GET">
        {{-- <input type="d" class="form-control" name="email" value="{{\Request::get('email')}}"> --}}
        <div class="row my-2">
            <div class="col-md-2 my-auto">
                <label for="startDate"><strong>Tanggal Awal</strong></label>
            </div>
            <div class="col-md-3">
                <div class="input-group date">
                    <input type="date" id="startDate" name="startDate" class="form-control" autofocus data-parsley-required="true" value="{{\Request::get('startDate')}}">
                </div>
            </div>
            <div class="col-md-2 my-auto">
                <label for="endDate"><strong>Tanggal Akhir</strong></label>
            </div>
            <div class="col-md-3">
                <div class="input-group date">
                    <input type="date" id="endDate" name="endDate" class="form-control" autofocus data-parsley-required="true" value="{{\Request::get('endDate')}}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary"> Cari </button>
            {{-- <button type="submit" class="btn btn-primary"> Cari </button> --}}
            <a href="{{ route('admin.laporan-pembelian.produk') }}" class="btn btn-white mx-2">Hapus Filter</a>
        </div>
        {{-- <button type="reset" class="btn btn-white"> Reset </button> --}}
        </form>
      </div>
      <hr>
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
<script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
<script src="{{ asset('/assets/plugins/smartwizard/dist/js/jquery.smartWizard.js') }}"></script>
<script src="{{ asset('/assets/js/demo/form-wizards-validation.demo.js') }}"></script>
<script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
<script src="{{ asset('/assets/js/custom/datetime-picker.js') }}"></script>
<script src="{{ asset('/assets/js/custom/string-helper.js') }}"></script>
<script>
    $( document ).ready(function() {
        $("#from-datepicker").datepicker({
            // format: 'yyyy-mm-dd'
        });
        $("#from-datepicker").on("change", function () {
            var fromdate = $(this).val();
            alert(fromdate);
        });
    });
    </script>
@endpush
