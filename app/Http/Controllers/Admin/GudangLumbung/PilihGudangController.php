<?php

namespace App\Http\Controllers\Admin\GudangLumbung;

use App\Http\Controllers\Controller;

class PilihGudangController extends Controller
{
    public function index()
    {
        return view('pages.admin.gudang-lumbung.pilih-gudang');
    }
}
