<?php

namespace App\Constants;

class RequestRuleConstant
{
    public static function userTable()
    {
        return [
            'user_name' => 'required|min:3',
            'user_email' => 'required|min:7|max:15',
            'user_password' => 'sometimes|required|min:6|confirmed',
        ];
    }

    public static function userProfileTable()
    {
        return [
            'user_profile_nik_ektp' => 'required',
            'user_profile_gender' => 'required|in:laki-laki,perempuan',
            'user_profile_tempat_lahir' => 'required',
            'user_profile_tanggal_lahir' => 'required',
            'user_profile_alamat' => 'required',
            'user_profile_no_telp' => 'required',
        ];
    }

    public static function settingTable()
    {
        return [
            'name' => 'required|unique:settings,name,' . request()->route('setting') . 'id',
            'value' => 'required'
        ];
    }

    public static function accountTable()
    {
        return [
            'account_name' => 'required|min:2',
            'account_number' => 'required|min:3|integer',
            'account_opening_balance' => 'sometimes|required',
            'account_bank_name' => 'nullable',
            'account_bank_address' => 'nullable',
            'account_bank_phone' => 'nullable',
            'account_enabled' => 'sometimes|required',
        ];
    }

    public static function paymentMethodTable()
    {
        return [
            'pm_name' => 'required|min:3',
        ];
    }

    public static function shippingTable()
    {
        return [
            'shipping_name' => 'required|min:3',
            'shipping_office_phone' => 'nullable',
            'shipping_office_address' => 'nullable',
        ];
    }

    public static function shipperTable()
    {
        return [
            'shipper_name' => 'required|min:3',
            'shipper_phone' => 'nullable',
            'shipper_address' => 'nullable',
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
