<p style="text-align: center;">
    <strong>LAPORAN PERKIRAAN PEMBELIAN (MODAL) </strong>
</p>
<p style="text-align: center;">
    <strong>MUSIM PANEN APA</strong>
</p>
<p style="text-align: center;">
    <strong>LUMBUNG DESA</strong>
</p>
<p style="text-align: left;"></p>
<p style="text-align: left; padding-left: 60px;">
    <label for="name">
        <strong>Jumlah petani penjual</strong> &nbsp; &nbsp; : {{ $jumlahpetani }}</p>
    </label>
<p style="text-align: left; padding-left: 60px;">
    <label for="name">
        <strong>Total Produk</strong> <em>(item)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</em>: {{ $totalproduk }}</p>
    </label>
<p style="text-align: left; padding-left: 60px;">
    <label for="name">
        <strong>Total Berat Produk</strong>&nbsp;(/kg)&nbsp;
    </label>: {{ $totalberatproduk }} kg</p>
<p style="text-align: left; padding-left: 60px;">
    <label for="name">
        <strong>Modal&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong>
    </label>: @currency($perkiraanmodal)</p>
<div class="row">
    <div class="col-md-2 my-auto">&nbsp;</div>
    <div class="col-md-2 my-auto">
        <table style="width: 962px; height: 43px; padding-left: 60px;" border="1">
            <tbody>
                <tr>
                    <td style="width: 32px; text-align: center;">No</td>
                    <td style="width: 119px; text-align: center;">Petani</td>
                    <td style="width: 139px; text-align: center;">Produk</td>
                    <td style="width: 160.25px; text-align: center;">Kondisi</td>
                    <td style="width: 110.75px; text-align: center;">Luas Lahan</td>
                    <td style="width: 86px; text-align: center;">Jumlah (/kg)</td>
                    <td style="width: 145px; text-align: center;">Harga</td>
                    <td style="width: 106px; text-align: center;">Total</td>
                </tr>
                @foreach ($data as $datas)
                <tr>
                    <td style="width: 32px;">{{ $loop->iteration }}</td>
                    <td style="width: 119px;">{{ $datas->petani->nama }}</td>
                    <td style="width: 139px;">{{ $datas->tanaman_id }}</td>
                    <td style="width: 160.25px;">{{ $datas->kondisi->nama }}</td>
                    <td style="width: 110.75px;">{{ $datas->luas_lahan }}</td>
                    <td style="width: 86px;">{{ $datas->jumlah }}</td>
                    <td style="width: 145px;">@currency($datas->harga)</td>
                    <td style="width: 106px;">@currency($datas->total)</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
