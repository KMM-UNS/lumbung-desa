<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $roles = Role::pluck('name', 'id');
        $data = Auth::user();
        return view('pages.profile.edit-profile', [
            'data' => $data,
            'roles' => $roles
        ]);
    }
}
