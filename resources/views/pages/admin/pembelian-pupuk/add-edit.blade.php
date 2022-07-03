@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Pembelian Pupuk' : 'Create Pembelian Pupuk' )

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">Data Pembelian</a></li>
  <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Data Pembelian<small> @yield('title')</small></h1>
<!-- end page-header -->


<!-- begin panel -->
<form action="{{ isset($data) ? route('admin.pembelian.pembelian-pupuk.update', $data->id) : route('admin.pembelian.pembelian-pupuk.store') }}" id="form" name="form" method="POST" data-parsley-validate="true">
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
          {{-- <div class="col-md-1 my-auto">
            <label for="name"><strong>Nomor Pembelian</strong></label>
          </div> --}}
          <div class="col-md-11">
            {{-- <input type="text" id="no_pembelian" name="no_pembelian" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->no_pembelian ?? old('no_pembelian') }}}"> --}}
            <input type="hidden" id="no_pembelian" name="no_pembelian" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->no_pembelian ?? old('no_pembelian') }}}">
          </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-1 my-auto">
              <label for="name"><strong>Tanggal Pembelian</strong></label>
            </div>
            <div class="col-md-11">
              <input type="date" id="tanggal_pembelian" name="tanggal_pembelian" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->tanggal_pembelian ?? old('tanggal_pembelian') }}}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
          <div class="col-md-1 my-auto">
            <label for="name"><strong>Pupuk</strong></label>
          </div>
          <div class="col-md-10">
            <x-form.Dropdown name="pupuk_id" :options="$pupuk" selected="{{{ old('pupuk_id') ?? ($data['pupuk_id'] ?? null) }}}" required />
          </div>
          <div class="col-md-1">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal-pupuk">+ produk</button>
          </div>
        </div>
    </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Jumlah Pembelian</strong></label>
                </div>
                <div class="col-md-11">
                    <input type="number" id="jumlah" onkeyup="sum();" name="jumlah" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->jumlah ?? old('jumlah') }}}">
                </div>
            </div>
        </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-1 my-auto">
                <label for="name"><strong>Harga</strong></label>
            </div>
            <div class="col-md-11">
                <input type="number" id="harga" onkeyup="sum();" name="harga" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->harga ?? old('harga') }}}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-1">
                <label for="name"><strong>Total</strong></label>
            </div>
            <div class="col-md-11">
                <input readonly type="number" id="total" onkeyup="sum();" name="total" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->total ?? old('total') }}}">
            </div>
        </div>
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

{{-- Begin Modal Form Produk --}}
<div class="modal fade modal-pupuk" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- begin panel -->
            <form action="{{ route('admin.master-data.datapupuk.store') }}" id="form" name="form" method="POST" data-parsley-validate="true">
                @csrf
                <div class="panel panel-inverse">
                  <!-- begin panel-heading -->
                  <div class="panel-heading">
                    <h4 class="panel-title">Form Tambah Data Pupuk</h4>
                  </div>
                  <!-- end panel-heading -->
                  <!-- begin panel-body -->
                  <div class="panel-body">
                    <div class="form-group">
                      <label for="name">Nama</label>
                      <input type="text" id="nama" name="nama" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->nama ?? old('nama') }}}">
                      <label for="name">Jenis Pupuk</label>
                      <input type="text" id="jenis_pupuk" name="jenis_pupuk" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->jenis_pupuk ?? old('jenis_pupuk') }}}">
                      <label for="name">Berat (per Kg)</label>
                      <input type="text" id="berat" name="berat" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->berat ?? old('berat') }}}">
                      <label for="name">Harga (per Kg)</label>
                      <input type="text" id="harga" name="harga" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->harga ?? old('harga') }}}">
                      </div>
                  </div>
                  <!-- end panel-body -->
                  <!-- begin panel-footer -->
                  <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                  <!-- end panel-footer -->
                </div>
                <!-- end panel -->
            </form>
        </div>
    </div>
  </div>
{{-- end modal form produk --}}

@endsection

@push('scripts')
<script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
<script>
    function sum() {
        var txtFirstNumberValue = document.getElementById('jumlah').value;
        var txtSecondNumberValue = document.getElementById('harga').value;
        var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
        if (!isNaN(result)) {
            document.getElementById('total').value=result;
        }
    }
</script>
@endpush
