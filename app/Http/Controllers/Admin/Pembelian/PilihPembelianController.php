<?php

namespace App\Http\Controllers\Admin\Pembelian;

use App\DataTables\Admin\Pembelian\PembelianDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PilihPembelianController extends Controller
{
    public function index(PembelianDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.pembelian.pilih-pembelian');
    }
}
