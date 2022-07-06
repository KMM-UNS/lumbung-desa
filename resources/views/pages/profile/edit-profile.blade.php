@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Update Profile' )

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
<form action="{{ route('admin.users.update', $data->id) }}" id="form" name="form" method="POST" data-parsley-validate="true" redirect-back="false">
    @csrf
    {{ method_field('PUT') }}
    <div class=" row">
        <div class="col-md-6 ui-sortable">
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Login Info</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="user_name" name="user_name" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->name ?? old('user_name') }}}">
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" id="user_email" name="user_email" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->email ?? old('user_email') }}}">
                    </div>
                    <div class="form-group" hidden>
                        <label>Peran</label>
                        <x-form.dropdown name="user_roles[]" :options="$roles" :selected="old('user_roles') ?? (isset($data->roles) ? $data->roles->pluck('id')->toArray() : null)" placeholder="Roles" multiple />
                    </div>
                    <div class="form-group">
                        <label for="name">Kata Sandi</label>
                        <input type="password" id="user_password" name="user_password" class="form-control" autofocus data-parsley-required="{{{ isset($data) ? 'false' : 'true' }}}" value="{{ old('user_password') }}">
                        @if(isset($data))
                        <small class="text-red">*Kosongkan bila tidak ada perubahan</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="name">Konfirmasi Kata Sandi</label>
                        <input type="password" id="user_password_confirmation" name="user_password_confirmation" class="form-control" autofocus data-parsley-required="{{{ isset($data) ? 'false' : 'true' }}}" value="">
                    </div>
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end ui-sortable -->
        <div class="col-xl-6 ui-sortable">
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Profile</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="number" name="user_profile_nik_ektp" class="form-control m-b-5" placeholder="NIK" value="{{{ old('user_profile_nik_ektp') ?? $data->profile->nik_ektp ?? null }}}" data-parsley-minlength="16" />
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <x-form.genderRadio name="user_profile_gender" selected="{{{ old('user_profile_gender') ?? $data->profile->gender ?? 'laki-laki'}}}" />
                    </div>
                    <div class="form-group">
                        <label>Tempat & Tanggal Lahir</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="user_profile_tempat_lahir" placeholder="Tempat Lahir" value="{{{ old('user_profile_tempat_lahir') ?? $data->profile->tempat_lahir ?? null }}}" />
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="user_profile_tanggal_lahir" class="form-control date-picker" placeholder="Tanggal Lahir" value="{{{ old('user_profile_tanggal_lahir') ?? (isset($data->profile->tanggal_lahir) ? $data->profile->tanggal_lahir->format('d-m-Y') : null) ?? null }}}" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telp.</label>
                        <input type="number" name="user_profile_no_telp" class="form-control" placeholder="" value="{{{ old('user_profile_no_telp') ?? $data->profile->no_telp ?? null }}}" />
                    </div>
                    <div class="form-group">
                        <label>Alamat Sekarang</label>
                        <textarea class="form-control" name="user_profile_alamat" id="user_profile_alamat" cols="30" placeholder="Alamat lengkap">{{{ old('user_profile_alamat') ?? $data->profile->alamat ?? null }}}</textarea>
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
        </div>
        <!-- end ui-sortable -->
    </div>

</form>
<a href="javascript:history.back(-1);" class="btn btn-success">
    <i class="fa fa-arrow-circle-left"></i> Kembali
</a>

@endsection

@push('scripts')
<script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
<script src="{{ asset('/assets/js/custom/ajax-form-handler.js') }}"></script>
<script src="{{ asset('/assets/js/custom/datetime-picker.js') }}"></script>
@endpush