<!doctype html>

<html lang="en">

    <head>
        <style>
            body{
            background:#eee;
            margin-top:20px;
            }
            .text-danger strong {
                        color: #9f181c;
                    }
                    .receipt-main {
                        background: #f7fff7 none repeat scroll 0 0;
                        border-bottom: 12px solid #ecffee;
                        border-top: 12px solid #c6ffb8;
                        margin-top: 50px;
                        margin-bottom: 50px;
                        padding: 40px 30px !important;
                        position: relative;
                        box-shadow: 0 1px 21px #acacac;
                        color: #333333;
                        font-family: open sans;
                    }
                    /* bawahnya lumbung desa */
                    .receipt-main p {
                        color: #333333;
                        font-family: open sans;
                        line-height: 1.42857;
                    }
                    .receipt-footer h1 {
                        font-size: 15px;
                        font-weight: 400 !important;
                        margin: 0 !important;
                    }
                    /* garis atas */
                    .receipt-main::after {
                        background: #b4ffd8 none repeat scroll 0 0;
                        content: "";
                        height: 5px;
                        left: 0;
                        position: absolute;
                        right: 0;
                        top: -13px;
                    }
                    /*kotak judul kolom */
                    .receipt-main thead {
                        background: #b6b6bd none repeat scroll 0 0;
                    }
                    /* tulisan judul kolom */
                    .receipt-main thead th {
                        color:rgb(9, 9, 9);
                    }
                    .receipt-right h5 {
                        font-size: 16px;
                        font-weight: bold;
                        margin: 0 0 7px 0;
                    }
                    .receipt-right p {
                        font-size: 12px;
                        margin: 0px;
                    }
                    .receipt-right p i {
                        text-align: center;
                        width: 18px;
                    }
                    .receipt-main td {
                        padding: 9px 20px !important;
                    }
                    .receipt-main th {
                        padding: 13px 20px !important;
                    }
                    .receipt-main td {
                        font-size: 13px;
                        font-weight: initial !important;
                    }
                    .receipt-main td p:last-child {
                        margin: 0;
                        padding: 0;
                    }
                    .receipt-main td h2 {
                        font-size: 20px;
                        font-weight: 900;
                        margin: 0;
                        text-transform: uppercase;
                    }
                    .receipt-header-mid .receipt-left h1 {
                        font-weight: 100;
                        margin: 34px 0 0;
                        text-align: right;
                        text-transform: uppercase;
                    }
                    .receipt-header-mid {
                        margin: 24px 0;
                        overflow: hidden;
                    }

                    #container {
                        background-color: #dcdcdc;
                    }
        </style>
    </head>
<body>

<div class="col-md-12">
    <div class="row">
           <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
               <div class="row">
                   <div class="receipt-header">

                    <center><h2>INVOICE</h2></center>
                       <div class="col-xs-6 col-sm-6 col-md-6">
                           <div class="receipt-left">
                               <img class="img-responsive" alt="iamgurdeeposahan" src="https://bootdey.com/img/Content/avatar/avatar6.png" style="width: 71px; border-radius: 43px;">
                           </div>
                       </div>
                       <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                           <div class="receipt-right">
                               <h5>Lumbung Desa</h5>
                               <p>+62 838 4498 245 <i class="fa fa-phone"></i></p>
                               <p>lumbungdesa@gmail.com <i class="fa fa-envelope-o"></i></p>
                               <p>Karanganyar <i class="fa fa-location-arrow"></i></p>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="row">
                   <div class="receipt-header receipt-header-mid">
                       <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                           <div class="receipt-right">
                               <h5>Nama Pembeli - {{ $nama }} <br>
                                Nomor Penjualan - {{ $no_penjualan }} <br>
                                Tanggal         - {{ $tgl_penjualan }} </h5>

                               {{-- <p><b>Mobile :</b> +1 12345-4569</p>
                               <p><b>Email :</b> customer@gmail.com</p>
                               <p><b>Address :</b> New York, USA</p> --}}
                           </div>
                       </div>
                       <div class="col-xs-4 col-sm-4 col-md-4">
                           <div class="receipt-left">
                               {{-- <h3>Nomor Penjualan - {{ $no_penjualan }}</h3> --}}
                           </div>
                       </div>
                   </div>
               </div>

               <div>
                   <table class="table table-bordered">
                       <thead>
                           <tr>
                               {{-- <th>Nomor Pembelian</th>
                               <th>Tanggal Pembelian</th>
                               <th>Nama Pembeli</th> --}}
                               <th>Produk</th>
                               <th>Kondisi</th>
                               <th>Keterangan</th>
                               <th>Jumlah (/Kg)</th>
                               <th>Harga (/Kg)</th>
                               {{-- <th>Kasir</th> --}}
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               {{-- <td class="col-md-9">{{ $no_penjualan }}</td>
                               <td class="col-md-9">{{ $tgl_penjualan }}</td>
                               <td class="col-md-9">{{ $namapembelippk }}</td> --}}
                               <td class="col-md-9">{{ $produk }}</td>
                               <td class="col-md-9">{{ $kondisi }}</td>
                               <td class="col-md-9">{{ $keterangan }}</td>
                               <td class="col-md-9">{{ $jumlah }}</td>
                               <td class="col-md-9">{{ $harga }}</td>
                               <td class="col-md-3"><i class="fa fa-inr"></i></td>
                           </tr>
                           {{-- <tr>
                               <td class="text-right">
                               <p>
                                   <strong>Total Amount: </strong>
                               </p>
                               <p>
                                   <strong>Late Fees: </strong>
                               </p>
                               <p>
                                   <strong>Payable Amount: </strong>
                               </p>
                               <p>
                                   <strong>Balance Due: </strong>
                               </p>
                               </td>
                               <td>
                               <p>
                                   <strong><i class="fa fa-inr"></i></strong>
                               </p>
                               <p>
                                   <strong><i class="fa fa-inr"></i> 500/-</strong>
                               </p>
                               <p>
                                   <strong><i class="fa fa-inr"></i> 1300/-</strong>
                               </p>
                               <p>
                                   <strong><i class="fa fa-inr"></i> 9500/-</strong>
                               </p>
                               </td>
                           </tr> --}}
                           <tr>
                               <td class="text-right"><h2><strong>Total: </strong></h2></td>
                               <td class="text-left text-danger"><h2><strong><i class="fa fa-inr"></i> {{ $total }} </strong></h2></td>
                           </tr>
                       </tbody>
                   </table>
               </div>

               <div class="row">
                   <div class="receipt-header receipt-header-mid receipt-footer">
                       <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                           <div class="receipt-right">
                               {{-- <p><b>Tanggal Penjualan :</b> {{ $tgl_penjualan }}</p> --}}
                               <h5 style="color: rgb(140, 140, 140);">Thanks for shopping!</h5>
                           </div>
                       </div>
                       <div class="col-xs-4 col-sm-4 col-md-4">
                           <div class="receipt-left">
                               <h1>Stamp</h1>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</body>
</html>
