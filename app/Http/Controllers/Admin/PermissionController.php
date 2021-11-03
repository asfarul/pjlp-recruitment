<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PermissionStoreRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $permissions = Permission::orderBy('created_at')->get();

        return view('admin.permission.perm_list', compact('permissions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.permission.perm_create');
    }

    /**
     * @param PermissionStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PermissionStoreRequest $request)
    {
        $permission = new Permission();
        $permission->name = $request->input('name');
        $permission->display_name = $request->input('display_name');
        $permission->description = $request->input('description');
        $permission->save();

        Toastr::success('Berhasil menambahkan permission');
        return redirect()->route('permission.index');
    }

    // Permission Delete Confirmation Page
    public function show($id)
    {
        //
        try {
            $permission = Permission::findOrFail($id);

            $params = [
                'title' => 'Delete Permission',
                'permission' => $permission,
            ];

            return view('admin.permission.perm_delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Permission Editing Page
    public function edit($id)
    {
        //
        try {
            $permission = Permission::findOrFail($id);

            $params = [
                'title' => 'Edit Permission',
                'permission' => $permission,
            ];

            //dd($role_permissions);

            return view('admin.permission.perm_edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Permission update to DB
    public function update(Request $request, $id)
    {
        //
        try {
            $permission = Permission::findOrFail($id);

            $this->validate($request, [
                'display_name' => 'required',
                'description' => 'required',
            ]);

            $permission->name = $request->input('name');
            $permission->display_name = $request->input('display_name');
            $permission->description = $request->input('description');

            $permission->save();

            return redirect()->route('permission.index')->with('success', "The permission <strong>$permission->name</strong> has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Permission Delete from DB
    public function destroy($id)
    {
        //
        try {
            $permission = Permission::findOrFail($id);
            DB::table("permission_role")->where('permission_id', $id)->delete();
            $permission->delete();

            return redirect()->route('permission.index')->with('success', "The Role <strong>$permission->name</strong> has successfully been archived.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
