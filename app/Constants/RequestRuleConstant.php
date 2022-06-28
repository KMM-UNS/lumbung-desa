<?php

namespace App\Constants;

class RequestRuleConstant
{
    public static function settingTable()
    {
        return [
            'name' => 'required|unique:settings,name,' . request()->route('setting') . 'id',
            'value' => 'required'
        ];
    }

    public static function adminTable()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:admins,email,' . request()->route('admin') . 'id',
            'pangkat' => 'nullable|string',
            'nrp' => 'nullable|integer',
            'password' => 'nullable',
            'department_id' => 'required'
        ];
    }

    public static function gudangTable()
    {
        return [
            'nama_tanaman_id' =>'exist:tanamen,id',
            'stok' => 'nullable|integer',
            'kondisi_id' => 'exist:kondisi_hasil_panen,id',
            'keterangan_id' => 'exist:keterangan_gudang,id'
        ];
    }

    public static function pembelianTable()
    {
        return [
            'no_pembelian' => 'nullable',
            'jumlah' => 'nullable|integer',
            'harga' => 'nullable|integer',
            'total' => 'nullable|integer'
        ];
    }
}
