<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDataTable;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserForm;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(UserDataTable $datatable)
    {
        return $datatable->render('pages.admin.user.index');
    }

    public function create()
    {
        $roles = Role::pluck('display_name', 'id');
        return view('pages.admin.user.add-edit', ['roles' => $roles]);
    }

    public function store(UserForm $request)
    {
        return DB::transaction(function () use ($request) {
            $msg = "Data Tersimpan";
            try {
                $data = User::createFromRequest($request);
                if (!empty($request->user_password)) {
                    $data->password = Hash::make($request->user_password);
                }
                $data->save();

                $data->attachRoles($request->user_roles);

                $profile = $data->profile()->firstOrNew();
                $profile->updateFromRequest($request);
                $profile->save();
            } catch (\Throwable $th) {
                DB::rollBack();
                $msg = "Error saving data";

                if ($request->wantsJson()) {
                    $request->flash();
                    toast($msg, 'error');
                    return response()->json([
                        'error' => $msg
                    ], 500);
                }
                return back()->withInput()->withToastError($msg);
            }

            if ($request->wantsJson()) {
                toast($msg, 'success');
                return response()->json([
                    'message' => $msg
                ]);
            }

            return redirect(route('admin.users.index'))->withToastSuccess($msg);
        });
    }

    public function edit($id)
    {
        $data = User::with(['profile', 'roles'])->findOrFail($id);
        $roles = Role::pluck('display_name', 'id');
        return view('pages.admin.user.add-edit', ['data' => $data, 'roles' => $roles]);
    }

    public function update(UserForm $request, User $user)
    {
        return DB::transaction(function () use ($request, $user) {
            $msg = 'Data berhasil diubah';

            try {
                $data = $user->updateFromRequest($request);
                if (!empty($request->user_password)) {
                    $data->password = Hash::make($request->user_password);
                }
                $data->roles()->sync($request->user_roles);
                $profile = $data->profile()->firstOrNew();
                $profile->updateFromRequest($request)->save();
                $data->save();
            } catch (\Throwable $th) {
                $msg = 'Error saving data';
                if ($request->wantsJson()) {
                    $request->flash();
                    toast($msg, 'error');
                    return response()->json([
                        'error' => $msg
                    ], 500);
                }
                return back()->withInput()->withToastError($msg);
            }

            if ($request->wantsJson()) {
                toast($msg, 'success');
                return response()->json([
                    'message' => $msg
                ]);
            }

            return redirect(route('admin.users.index'))->withToastSuccess($msg);
        });
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->profile()->delete();
            $user->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
