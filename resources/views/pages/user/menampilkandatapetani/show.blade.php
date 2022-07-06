@extends('layouts.user')

@section('title', 'Data Diri Petani')

@push('css')
<!-- datatables -->
<link href="{{ asset('/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/css/isidatacss/style.css') }}" rel="stylesheet" />
<!-- end datatables -->
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
<h1 class="page-header">Master Data<small></small></h1>
<!-- end page-header -->


<!-- begin panel -->
<div class="panel panel-inverse">
    <!-- begin panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title"></h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
    {{-- <div class="panel-body">
        <h1 class="text-center">Anda Belum Mengisi Data Petani !</h1>
    </div> --}}
    <!-- nanti isi table disini  -->
    <div class="container">
        {{-- <div class="row"> --}}
            <h2 class="text-center">Biodata Diri</h2>
        {{-- </div> --}}
    </div>
    <br>
    <div class="container">
        <div class="card kartu">
            <div class="row">
                {{-- <div class="col-md-4">
                    <div class="foto">
                        <img src="foto/bayuafrizatulrizki.jpg" class="img-thumbnail" alt="" width="150" height="auto">
                    </div>
                </div> --}}
                <div class="col-md-8 kertas-biodata">
                    <div class="biodata">
                        <table width="100%" border="0">
                            <tbody>
                                <tr>
                                    <td valign="top">
                                        <table border="0" width="100%" style="padding-left: 2px; padding-right: 13px;">
                                            <tbody>
                                                @foreach ($datapetani as $datapetanis)
                                                <tr>
                                                    <td width="25%" valign="top" class="textt">Nama Petani</td>
                                                    <td width="2%">:</td>
                                                    <td style="color: #e9a7f9; font-weight:bold">{{$datapetanis->nama}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="textt">Nomor KK</td>
                                                    <td>:</td>
                                                    <td>{{$datapetanis->no_kk}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="textt">NIK</td>
                                                    <td>:</td>
                                                    <td>{{$datapetanis->nik}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="textt">Tempat Lahir</td>
                                                    <td>:</td>
                                                    <td>{{$datapetanis->tempat_lahir}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="textt">Tanggal Lahir</td>
                                                    <td>:</td>
                                                    <td>{{$datapetanis->tanggal_lahir}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="textt">Jenis Kelamin</td>
                                                    <td>:</td>
                                                    <td>{{$datapetanis->jenis_kelamin}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="textt">Alamat </td>
                                                    <td>:</td>
                                                    <td>{{$datapetanis->alamat}}</td>
                                                </tr>

                                                @endforeach
                                                {{-- <tr>
                                                    <td class="textt">Jenis Kelamin</td>
                                                    <td>:</td>
                                                    <td>{{$dataanak->jenis_kelamin}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="textt">Anak Ke</td>
                                                    <td>:</td>
                                                    <td>{{$dataanak->anak_ke}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="textt">Nama Orangtua</td>
                                                    <td>:</td>
                                                    <td>{{$dataanak->nama_orangtua}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="textt">No Handphone Orangtua</td>
                                                    <td>:</td>
                                                    <td>{{$dataanak->no_hp_orangtua}}</td>
                                                </tr> --}}

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end panel-body -->
    <br>
    {{-- <div class="panel-footer">
        <a href="{{route('user.menampilkandatapetani.create')}}"><button type="submit" class="btn btn-primary">Isi Biodata</button></a>
        <button type="reset" class="btn btn-default">Reset</button>
    </div> --}}

</div>
</div>
<!-- end panel -->
@endsection

@push('scripts')
<!-- datatables -->
<script src="{{ asset('assets/js/custom/datatable-assets.js') }}"></script>

<!-- end datatables -->

<script src="{{ asset('assets/js/custom/delete-with-confirmation.js') }}"></script>
<script>
    $(document).on('delete-with-confirmation.success', function() {
        $('.buttons-reload').trigger('click')
    })
</script>
@endpush
