<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>Chart Sample</title> --}}
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
@extends('layouts.user')

@section('title', 'Morris Chart')

@push('css')
	<link href="/assets/plugins/morris.js/morris.css" rel="stylesheet" />
@endpush

@section('content')
<div align="center">
	<h1 class="page-header"><strong>Riwayat Penjualan</strong></h1>
    </div>
	<!-- end page-header -->
	<!-- begin row -->
    <div class="row">
        <div class="col-md-12">
            <table class="table table-primary table-striped">
                <thead>
                    <tr>
                        <th scope="col"><strong> Nomor Penjualan </strong></th>
                        <th scope="col"><strong> Tanggal </strong></th>
                        <th scope="col"><strong> Musim Panen </strong></th>
                        <th scope="col"><strong> Tanaman </strong></th>
                        <th scope="col"><strong> Jumlah </strong></th>
                        <th scope="col"><strong> Kondisi </strong></th>
                        <th scope="col"><strong> Harga </strong></th>
                        <th scope="col"><strong> Total </strong></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayatpenjualan as $riwayatpenjualans)
                    <tr>
                        <td>{{ $riwayatpenjualans->no_pembelian }}</td>
                        <td>{{ $riwayatpenjualans->tanggal_pembelian}}</td>
                        <td>{{ $riwayatpenjualans->musim->nama}}</td>
                        <td>{{ $riwayatpenjualans->tanamen->nama }}</td>
                        <td>{{ $riwayatpenjualans->jumlah }}</td>
                        <td>{{ $riwayatpenjualans->kondisi_hasil_panen->nama }}</td>
                        <td>{{ $riwayatpenjualans->keluhan }}</td>
                        <td>{{ $riwayatpenjualans->harga }}</td>
                        <td>{{ $riwayatpenjualans->total}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
</body>
</html>
