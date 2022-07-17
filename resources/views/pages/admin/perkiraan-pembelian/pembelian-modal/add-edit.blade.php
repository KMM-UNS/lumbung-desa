@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Data Perkiraan Pembelian' : 'Create Data Perkiraan Pembelian' )

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
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
<form action="{{ isset($data) ? route('admin.pembelian.pembelian-modal.update', $data->id) : route('admin.pembelian.pembelian-modal.store') }}" id="form" name="form" method="POST" data-parsley-validate="true">
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
                <div class="col-md-12">
                    {{-- <input type="text" id="musim_panen_id" name="musim_panen_id" class="form-control" autofocus data-parsley-required="true" value="{{{ isset($data) ? route('admin.pembelian.pembelian-modal.update', $data->musim_panen_id) : route('admin.pembelian.pembelian-modal.store', $id) }}}"> --}}
                    <input type="hidden" id="musim_panen_id" name="musim_panen_id" class="form-control" autofocus data-parsley-required="true" value="{{ $id }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Petani</strong></label>
                </div>
                <div class="col-md-5">
                    <x-form.Dropdown name="petani_id" :options="$petani" selected="{{{ old('petani_id') ?? ($data['petani_id'] ?? null) }}}" required />
                </div>
                <div class="col-md-1">
                    <label for="name"><strong>Luas Tanam</strong></label>
                </div>
                <div class="col-md-5">
                    <input type="text" id="luas_lahan" name="luas_lahan" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->luas_lahan ?? old('luas_lahan') }}}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                {{-- <div class="col-md-1 my-auto">
                    <label for="name"><strong>Lahan</strong></label>
                </div>
                <div class="col-md-5">
                    <x-form.Dropdown name="lahan_id" :options="$lahan" selected="{{{ old('lahan_id') ?? ($data['lahan_id'] ?? null) }}}" required />
                </div> --}}
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Produk</strong></label>
                </div>
                <div class="col-md-5">
                    <x-form.Dropdown name="tanaman_id" :options="$tanaman" selected="{{{ old('tanaman_id') ?? ($data['tanaman_id'] ?? null) }}}" required />
                </div>
                <div class="col-md-1 my-auto">
                  <label for="name"><strong>Kondisi</strong></label>
                </div>
                <div class="col-md-5">
                  <x-form.Dropdown name="kondisi_id" :options="$kondisi" selected="{{{ old('kondisi_id') ?? ($data['kondisi_id'] ?? null) }}}" required />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1 my-auto">
                  <label for="name"><strong>Jumlah Pembelian</strong></label>
                </div>
                <div class="col-md-5">
                  <input type="number" id="jumlah" onkeyup="sum();" name="jumlah" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->jumlah ?? old('jumlah') }}}">
                </div>
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Harga</strong></label>
                </div>
                <div class="col-md-5">
                    <input type="number" id="harga" onkeyup="sum();" name="harga" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->harga ?? old('harga') }}}">
                </div>
                {{-- <div class="col-md-1">
                  <x-form.Dropdown name="satuan_id" :options="$satuan" selected="{{{ old('satuan_id') ?? ($data['satuan_id'] ?? null) }}}" required />
                </div> --}}
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1 my-auto">
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
