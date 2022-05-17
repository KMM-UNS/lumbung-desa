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
            'stok' => 'nullable|integer'
        ];
    }

    public static function pembelianTable()
    {
        return [
            'no_pembelian' => 'nullable|integer',
            'jumlah' => 'nullable|integer',
            'harga' => 'nullable|integer',
            'total' => 'nullable|integer'
        ];
    }
}
