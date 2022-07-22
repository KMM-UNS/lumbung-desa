 @extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Dashboard')

@push('css')
<link href="/assets/plugins/morris.js/morris.css" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">Chart</a></li>
  <li class="breadcrumb-item active">Morris Chart</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Grafik Penjualan</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Grafik Penjualan Produk Bulanan </div>
                <div class="card-body">
                    <div id="grafik"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src= "https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
var pendapatan = <?php echo json_encode($total_harga) ?>;
var bulan = <?php echo json_encode($bulan) ?>;
Highcharts.chart('grafik', {
    title : {
        text: 'Grafik Pendapatan Penjualan Produk Bulanan'
    },
    xAxis : {
        // categories : bulan
        categories : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
    },
    yAxis : {
        title: {
            text : 'Nominal Pendapatan Bulanan'
        }
    },
    plotOptions: {
        series: {
            allowPoinySelect: true
        }
    },
    series: [
        {
            name: 'Nominal Pendapatan',
            data: pendapatan
        }
    ]
});
</script>

@endsection


@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
@endpush

