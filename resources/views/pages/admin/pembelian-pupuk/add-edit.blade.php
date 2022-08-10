@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Pembelian Pupuk' : 'Tambah Pembelian Pupuk' )

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Pembelian</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Pembelian<small> @yield('title')</small></h1>
<!-- end page-header -->

<!-- begin panel -->
<div class="row">
    <div class="col-md-5">
        <form action="{{ route('admin.pembelian.pembelian-pupuk.add') }}" id="form" name="form" method="POST" data-parsley-validate="true">
            @csrf
            @method('POST')
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
                            <div class="col-md-2 my-auto">
                                <label for="name"><strong>Pupuk</strong></label>
                            </div>
                            <div class="col-md-9">
                                <x-form.Dropdown name="pupuk_order_id" :options="$pupuk" selected="{{{ old('pupuk_order_id') ?? ($data['pupuk_order_id'] ?? null) }}}" required />
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal-pupuk"><i class="fas fa-plus"> </i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2 my-auto">
                                <label for="name"><strong>Jumlah</strong></label>
                            </div>
                            <div class="col-md-10">
                                <input type="number" id="jumlah" onkeyup="sum();" name="jumlah" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->jumlah ?? old('jumlah') }}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2 my-auto">
                                <label for="name"><strong>Harga</strong></label>
                            </div>
                            <div class="col-md-10">
                                <input type="number" id="harga" onkeyup="sum();" name="harga" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->harga ?? old('harga') }}}">
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="name"><h4><strong>Total</strong><h4></label>
                            </div>
                            <div class="col-md-10">
                                <input readonly type="number" id="total" onkeyup="sum();" name="total" class="form-control-plaintext" autofocus data-parsley-required="true" value="{{{ $data->total ?? old('total') }}}">
                            </div>
                        </div>
                </div>
                <!-- end panel-body -->
                <!-- begin panel-footer -->
                <div class="panel-footer text-right">
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-warning">Tambah</button>
                </div>
                <!-- end panel-footer -->
            </div>
        </form>
    </div>
    <div class="col-md-7">
        <form action="{{ route('admin.pembelian.pembelian-pupuk.store') }}" method="POST">
            @csrf
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Detail Pembelian</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <input type="hidden" id="no_pembelian" name="no_pembelian" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->no_pembelian ?? old('no_pembelian') }}}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2 my-auto">
                                <label for="name"><strong>Tanggal</strong></label>
                            </div>
                            <div class="col-md-10">
                                <input type="date" id="tanggal_pembelian" name="tanggal_pembelian" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->tanggal_pembelian ?? old('tanggal_pembelian') }}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2 my-auto">
                                <label for="name"><strong>Supplier</strong></label>
                            </div>
                            <div class="col-md-10">
                                <x-form.Dropdown name="penjual_id" :options="$penjual" selected="{{{ old('penjual_id') ?? ($data['penjual_id'] ?? null) }}}" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col"><strong> No </strong></th>
                                            {{-- <th scope="col"><strong> Tanggal </strong></th>
                                            <th scope="col"><strong> Supplier </strong></th> --}}
                                            <th scope="col"><strong> Produk </strong></th>
                                            <th scope="col"><strong> Jumlah </strong></th>
                                            <th scope="col"><strong> Harga </strong></th>
                                            <th scope="col"><strong> Total </strong></th>
                                            <th scope="col" class="text-center"><strong> Action </strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $carts)
                                        <input type="hidden" id="pupuk_order_id" name="order_pupuk_id[]" class="form-control" autofocus data-parsley-required="true" value="{{ $carts->pupuk_order_id }}">
                                        <input type="hidden" id="jumlah" name="jumlah[]" class="form-control" autofocus data-parsley-required="true" value="{{ $carts->jumlah }}">
                                        <input type="hidden" id="harga" name="harga[]" class="form-control" autofocus data-parsley-required="true" value="{{ $carts->harga }}">
                                        <input type="hidden" id="total" name="total[]" class="form-control" autofocus data-parsley-required="true" value="{{ $carts->total }}">
                                        <input type="hidden" id="status" name="status[]" class="form-control" autofocus data-parsley-required="true" value="1">
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $carts->order_pupuk->nama }}</td>
                                            <td>{{ $carts->jumlah }}</td>
                                            <td>{{ $carts->harga }}</td>
                                            <td>{{ $carts->total }}</td>
                                            <td class="text-center"><a href="{{ route('admin.pembelian.pembelian-pupuk.hapus', $carts->id) }}"><i class="fas fa-trash"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row text-right">
                        <div class="col-md-7"></div>
                        <div class="col-md-3">
                            <label for="name"><h4><strong>Sub Total</strong><h4></label>
                        </div>
                        <div class="col-md-2">
                            @if($cart)
                            <input type="hidden" id="subtotal" name="subtotal" class="form-control" autofocus data-parsley-required="true" value="{{ $cart->sum('total') }}">
                                <p class="h4">
                                Rp. {{ $cart->sum('total') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- end panel-body -->
                <!-- begin panel-footer -->
                <div class="panel-footer text-right">
                    <button type="submit"  class="btn btn-primary btn-block">Bayar</button>
                </div>
                <!-- end panel-footer -->
            </div>
        </form>
    </div>
</div>
<!-- end panel -->

{{-- Begin Modal Form Produk --}}
<div class="modal fade modal-pupuk" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- begin panel -->
            <form action="{{ route('admin.master-data.datapupuk.simpan') }}" id="form" name="form" method="POST" data-parsley-validate="true">
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
                            <label for="name">Berat (Kg)</label>
                            <input type="text" id="berat" name="berat" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->berat ?? old('berat') }}}">
                            <label for="name">Harga (/Kg)</label>
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

<script src="{{ asset('assets/js/custom/delete-with-confirmation.js') }}"></script>
    <script>
        $(document).on('delete-with-confirmation.success', function() {
            $('.buttons-reload').trigger('click')
        })
    </script>
@endpush
