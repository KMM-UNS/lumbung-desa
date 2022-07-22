@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Penjualan Produk' : 'Create Penjualan Produk' )

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">Master Data</a></li>
  <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Master Data<small> @yield('title')</small></h1>
<!-- end page-header -->


<!-- begin panel -->
<form action="{{ isset($data) ? route('admin.penjualan.penjualanppk.update', $data->id) : route('admin.penjualan.penjualanppk.store') }}" id="form" name="form" method="POST" data-parsley-validate="true">
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
        {{-- @foreach ($data as $data ) --}}


      {{-- <div class="form-group"> --}}
        <div class="control-group after-add-more">
        {{-- <label for="name">Nomor Penjualan</label> --}}
        <input type="hidden" id="no_penjualan" name="no_penjualan" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->no_penjualan ?? old('no_penjualan') }}}">
        <label for="name">Tanggal Penjualan</label>
        <input type="date" id="tgl_penjualan" name="tgl_penjualan" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->tgl_penjualan ?? old('tgl_penjualan') }}}">
        <label for="name">Nama Pembeli</label>
        <x-form.Dropdown name="namapembelippk" :options="$pembeli" selected="{{{ old('namapembelippk') ?? ($data['namapembelippk'] ?? null) }}}" required />
        {{-- <label for="name">Email</label> --}}
        {{-- <input type="text" id="email" name="email" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->email ?? old('email') }}}"> --}}
        {{-- <label for="name">Nomor Handphone</label> --}}
        {{-- <input type="text" id="no_hp" name="no_hp" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->no_hp ?? old('no_hp') }}}"> --}}
        {{-- <label for="name">Alamat</label> --}}
        {{-- <input type="text" id="alamat" name="alamat" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->alamat ?? old('alamat') }}}"> --}}
        {{-- <label for="name">Kondisi</label>
        <x-form.Dropdown name="kondisi" :options="$kondisihasilpanen" selected="{{{ old('kondisihasilpanen') ?? ($data['kondisihasilpanen'] ?? null) }}}" required />
       --}}
       <label for="name">Produk</label>
       <x-form.Dropdown name="produk_id" :options="$produkppk" selected="{{{ old('produk_id') ?? ($data['produk_id'] ?? null) }}}" required />
       {{-- <label for="name">Kondisi</label> --}}
       {{-- <x-form.Dropdown name="kondisi_pr" :options="$kondisi" selected="{{{ old('kondisi_pr') ?? ($data['kondisi_pr'] ?? null) }}}" required /> --}}
       {{-- <label for="name">Keterangan</label> --}}
       {{-- <x-form.Dropdown name="keterangan_pr" :options="$keterangan" selected="{{{ old('keterangan_pr') ?? ($data['keterangan_pr'] ?? null) }}}" required /> --}}
       <label for="name">Jumlah (/Kg)</label>
        <input type="number" id="jumlah" name="jumlah" onkeyup="sum();" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->jumlah ?? old('jumlah') }}}">
        <label for="name">Harga (/Kg)</label>
        <input type="number" id="harga" name="harga" onkeyup="sum();" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->harga ?? old('harga') }}}">
       <label for="name">Total</label>
        <input readonly type="number" id="total" onkeyup="sum();" name="total" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->total ?? old('total') }}}">
      </div>
      {{-- @endforeach --}}
    </div>
    <!-- end panel-body -->
    <!-- begin panel-footer -->
    <div class="panel-footer">
    <button class="btn btn-success add-more" type="button">
        <i class="glyphicon glyphicon-plus"></i> Add
      </button>
    </div>
    <div class="panel-footer">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <button type="reset" class="btn btn-default">Reset</button>
    </div>
    <!-- end panel-footer -->
  </div>
  <!-- end panel -->
</form>
<div class="copy hide">
    <div class="control-group">
        <label disabled for="name">Nomor Penjualan</label>
        <input type="text" id="no_penjualan" name="no_penjualan"  value="{{{ 'no_penjualan' ?? old('no_penjualan') }}}">
        <label for="name">Tanggal Penjualan</label>
        <input type="date" id="tgl_penjualan" name="tgl_penjualan" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->tgl_penjualan ?? old('tgl_penjualan') }}}">
        <label for="name">Nama Petani Pembeli</label>
        <input type="text" id="nama" name="nama" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->nama ?? old('nama') }}}">
        <label for="name">Email</label>
        <input type="text" id="email" name="email" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->nama ?? old('nama') }}}">
        <label for="name">Nomor Handphone</label>
        <input type="text" id="no_hp" name="no_hp" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->nama ?? old('nama') }}}">
        <label for="name">Alamat</label>
        <input type="text" id="alamat" name="alamat" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->nama ?? old('nama') }}}">
        <label for="name">Produk</label>
        <input type="text" id="produk" name="produk" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->produk ?? old('produk') }}}">
        <label for="name">Harga</label>
        <input type="number" id="harga" name="harga" onkeyup="sum();" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->harga ?? old('harga') }}}">
        <label for="name">Jumlah</label>
        <input type="number" id="jumlah" name="jumlah" onkeyup="sum();" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->jumlah ?? old('jumlah') }}}">
        {{-- <label for="name">Kondisi</label>
        <x-form.Dropdown name="kondisi" :options="$kondisihasilpanen" selected="{{{ old('kondisihasilpanen') ?? ($data['kondisihasilpanen'] ?? null) }}}" required />
       --}}
       <label for="name">Total</label>
        <input readonly type="number" id="total" onkeyup="sum();" name="total" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->total ?? old('total') }}}">

      <br>
      <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
      <hr>
    </div>
  </div>
</div>
</div>
</div>
</div>
<!-- fungsi javascript untuk menampilkan form dinamis  -->
<!-- penjelasan :
saat tombol add-more ditekan, maka akan memunculkan div dengan class copy -->
<script type="text/javascript">
    $(document).ready(function() {
      $(".add-more").click(function(){
          var html = $(".copy").html();
          $(".after-add-more").after(html);
      });

      // saat tombol remove dklik control group akan dihapus
      $("body").on("click",".remove",function(){
          $(this).parents(".control-group").remove();
      });
    });
</script>

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