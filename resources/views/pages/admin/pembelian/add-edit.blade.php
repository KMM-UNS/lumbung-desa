@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Pembelian' : 'Create Pembelian' )

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
<form action="{{ isset($data) ? route('admin.pembelian.pembelian.update', $data->id) : route('admin.pembelian.pembelian.store') }}" id="form" name="form" method="POST" data-parsley-validate="true">
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
                <div class="col-md-12">
                    <input type="hidden" id="no_pembelian" name="no_pembelian" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->no_pembelian ?? old('no_pembelian') }}}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Tanggal</strong></label>
                </div>
                <div class="col-md-11">
                    <input type="date" id="tanggal_pembelian" name="tanggal_pembelian" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->tanggal_pembelian ?? old('tanggal_pembelian') }}}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Nama Petani Penjual</strong></label>
                </div>
                <div class="col-md-5">
                    <x-form.Dropdown name="petani_id" :options="$petani" selected="{{{ old('petani_id') ?? ($data['petani_id'] ?? null) }}}" required />
                </div>
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Musim</strong></label>
                </div>
                <div class="col-md-5">
                    <x-form.Dropdown name="musim_id" :options="$musim" selected="{{{ old('musim_id') ?? ($data['musim_id'] ?? null) }}}" required />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1 my-auto">
                    <label for="name"><strong>Produk</strong></label>
                </div>
                <div class="col-md-4">
                    <x-form.Dropdown name="tanaman_id" :options="$tanaman" selected="{{{ old('tanaman_id') ?? ($data['tanaman_id'] ?? null) }}}" required />
                </div>
                <div class="col-md-1 text-center">
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target=".modal-produk">+ produk</button>
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
                    <label for="name"><strong>Jumlah</strong></label>
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
        <!--<div class="form-group">
            <div class="row">
                {{-- <div class="col-md-1"></div> --}}
                <div class="col-md-12">
                    <button type="button" class="btn btn-secondary btn-block">Tambah Item</button>
                </div>
                {{-- <div class="col-md-1"></div> --}}
            </div>
        </div> -->
    </div>
    <div class="panel-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-1 my-auto">
                    <label for="name"><h4><strong>Total</strong></h4></label>
                </div>
                <div class="col-md-11">
                    <input readonly type="number" id="total" onkeyup="sum();" name="total" class="form-control-plaintext" autofocus data-parsley-required="true" value="{{{ $data->total ?? old('total') }}}">
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
<div class="modal fade modal-produk" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- begin panel -->
    <form action="{{ route('admin.data-petani.tanaman.simpan') }}" id="form" name="form" method="POST" data-parsley-validate="true">
    @csrf

        <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">Form Tambah Produk</h4>
        </div>
        <!-- end panel-heading -->
        <!-- begin panel-body -->
        <div class="panel-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-1 my-auto">
                        <label for="name">Jenis Tanaman</label>
                    </div>
                    <div class="col-md-5">
                        <x-form.Dropdown name="jenis_tanaman_id" :options="$jenistanaman" selected="{{{ old('jenis_tanaman_id') ?? ($data['jenis_tanaman_id'] ?? null) }}}" required />
                    </div>
                    <div class="col-md-1 my-auto">
                        <label for="name">Nama</label>
                    </div>
                    <div class="col-md-5 my-auto">
                        <input type="text" id="nama" name="nama" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->nama ?? old('nama') }}}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-1 my-auto">
                        <label for="name">Musim Tanam</label>
                    </div>
                    <div class="col-md-5">
                        <x-form.Dropdown name="musim_tanam_id" :options="$musimtanam" selected="{{{ old('musim_tanam_id') ?? ($data['musim_tanam_id'] ?? null) }}}" required />
                    </div>
                    <div class="col-md-1 my-auto">
                        <label for="name">Waktu Tanam</label>
                    </div>
                    <div class="col-md-5">
                        <input type="text" id="waktu_tanam" name="waktu_tanam" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->waktu_tanam ?? old('waktu_tanam') }}}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-1 my-auto">
                        <label for="name">Pupuk</label>
                    </div>
                    <div class="col-md-5">
                        <x-form.Dropdown name="jenis_pupuk_id" :options="$pupuk" selected="{{{ old('jenis_pupuk_id') ?? ($data['jenis_pupuk_id'] ?? null) }}}" required />
                    </div>
                    <div class="col-md-1 my-auto">
                        <label for="name">Keterangan</label>
                    </div>
                    <div class="col-md-5">
                        <input type="text" id="keterangan" name="keterangan" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->keterangan ?? old('waktu_tanam') }}}">
                    </div>
                </div>
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
