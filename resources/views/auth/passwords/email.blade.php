@extends('layouts.empty', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', 'SPMB')

@section('content')
<!-- begin login -->
<div class="login login-with-news-feed">
    <!-- begin news-feed -->
    <div class="news-feed">
        <div class="news-image" style="background-image: url(/assets/img/login-bg/front.png)"></div>
        <div class="news-caption">
            <h4 class="caption-title"><b>S</b>PMB</h4>
            <p>
                Sistem Pendaftaran Mahasiswa Baru
            </p>
        </div>
    </div>
    <!-- end news-feed -->
    <!-- begin right-content -->
    <div class="right-content">
        <!-- begin login-header -->
        <div class="login-header mx-auto">
            <a href="#"><img src="{{asset('assets/img/login-bg/logo.png')}}" width="150"></a>
        </div>
        <!-- end login-header -->
        <!-- begin login-content -->
        <div class="login-content">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form action="{{ request()->routeIs('admin*') ? route('admin.password.email') : route('password.email') }}" method="POST" class="margin-bottom-0">
                @csrf
                <div class="form-group m-b-15">
                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus />

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="login-buttons">
                    <button type="submit" class="btn btn-success btn-block btn-lg"> {{ __('Send Password Reset Link') }}</button>
                </div>
                @if(!request()->routeIs('admin*'))
                <p>
                    <br />
                    Ingat kata sandi? <a href="{{route('login')}}">Masuk</a>
                </p>
                @endif
                <hr />
                <p class="text-center text-grey-darker">
                    &copy; <?= date('Y') ?> Mandiri Solusindo </p>
            </form>
        </div>
        <!-- end login-content -->
    </div>
    <!-- end right-container -->
</div>
<!-- end login -->
@endsection
