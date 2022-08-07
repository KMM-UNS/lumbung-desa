 @extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Grafik Penjualan Produk')

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
<h1 class="page-header">Grafik Penjualan Produk</h1>
<select class="form-control mb-3" style="width: 100px;" id="TahunLaporan" name="TahunLaporan">
    {{-- <option value="2022">2022</option> --}}
</select>
<div class="container">
    <div class="row justify-content-center">
        {{-- start --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Grafik Penjualan Produk Bulanan
                </div>
                <div class="card-body">
                    <div id="grafik"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src= "https://code.highcharts.com/highcharts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
var pendapatan = <?php echo json_encode($total_harga) ?>;
var bulan = <?php echo json_encode($bulan) ?>;
const all = <?php echo json_encode($all) ?>;

// console.log(bulan)
// console.log(pendapatan)
// console.log(all);

// const DATANEW = []
let date =  new Date().getFullYear();
all.map(item => {
    let splitDate = item.tgl_penjualan.split('-')

    Object.assign(item, { tahun: splitDate[0].toString(), bulan: splitDate[1], bulans: convertBulan(splitDate[1]) })
})

const uniq = _.uniqBy(all, 'tahun')

const TAHUN = []
uniq.map(item => {
    TAHUN.push(parseInt(item.tahun))
})

TAHUN.sort(function(a, b) {
    return b - a
})

NEWTAHUN = []
if (TAHUN.length > 2) {
    for (let i = 0; i < 2; i++) {
        NEWTAHUN.push(TAHUN[i])
    }
} else {
    TAHUN.map(item => {
        NEWTAHUN.push(item)
    })
}

let hero = document.getElementById('TahunLaporan')
NEWTAHUN.map(item => {
    if (item === date) {
        result = "<option value="+item.toString()+" selected>"+item.toString()+"</option>"
    } else {
        result = "<option value="+item.toString()+">"+item.toString()+"</option>"
    }
	hero.innerHTML += result
})

$("#TahunLaporan").change(function () {
    showGrafikByTahun($(this).val())
});

const DATABULANAWAL = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']

function showGrafikByTahun(tahun) {
//   return p1 * p2;   // The function returns the product of p1 and p2

    const NEWDATA = []
    const TAHUNINI = uniq.filter((val) => val.tahun.toString() === tahun.toString())
    const LISTBULAN = []
    TAHUNINI.map(item => {
        const dataSelectedYear = all.filter((val) => val.tahun.toString() === tahun.toString())

        const FILTERBULAN = []
        DATABULANAWAL.map(item => {
            const filterBulan = dataSelectedYear.filter((val) => val.bulans.toUpperCase() === item.toUpperCase())

            FILTERBULAN.push(filterBulan)
        })

        const HITUNGPENJUALAN = []
        FILTERBULAN.map(item => {
            let sumWithInitial = item.reduce(
                (previousValue, currentValue) => previousValue + parseInt(currentValue.total),
                0
            );
            HITUNGPENJUALAN.push(sumWithInitial)
        })

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
                    text : 'Nominal Pendapatan'
                },
                labels: {
                    formatter: function() {
                        return convertToRupiah(this.value);
                    }
                }
            },
            plotOptions: {
                series: {
                    allowPoinySelect: true
                }
            },
            series: [
                {
                    name: 'Bulan',
                    data: HITUNGPENJUALAN
                }
            ]
        });
    })
}

showGrafikByTahun(date)

function convertToRupiah(value) {
      value = parseFloat(value)
      let rupiah = ''
      let valueRev = value.toString().split('').reverse().join('')
      for (let i = 0; i < valueRev.length; i++) {
        if (i % 3 === 0) rupiah += `${valueRev.substr(i, 3)}.`
      }
      const rp = rupiah
          .split('', rupiah.length - 1)
          .reverse()
          .join('')
      if (rupiah === 'NaN.' || rupiah === 'NaN') {
        return '...'
      }
      return `Rp ${rp}`
    }

function convertBulan(bulan) {
    let nama_bulan;
    switch (bulan) {
            case '01':
            nama_bulan = 'Januari'
            break;
            case '02':
            nama_bulan = 'Februari'
            break;
            case '03':
            nama_bulan = 'Maret'
            break;
            case '04':
            nama_bulan = 'April'
            break;
            case '05':
            nama_bulan = 'Mei'
            break;
            case '06':
            nama_bulan = 'Juni'
            break;
            case '07':
            nama_bulan = 'Juli'
            break;
            case '08':
            nama_bulan = 'Agustus'
            break;
            case '09':
            nama_bulan = 'September'
            break;
            case '10':
            nama_bulan = 'Oktober'
            break;
            case '11':
            nama_bulan = 'November'
            break;
            case '12':
            nama_bulan = 'Desember'
            break;

        default:
            break;
    }

    return nama_bulan
}

</script>

@endsection

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
@endpush

