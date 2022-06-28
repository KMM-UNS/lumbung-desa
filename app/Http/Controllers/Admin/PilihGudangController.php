<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\GudangLumbung\GudangLumbungDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PilihGudangController extends Controller
{
    public function index(GudangLumbungDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.gudang-lumbung.pilih-gudang');
    }
}
