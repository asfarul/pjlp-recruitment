<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.roles_list', compact('roles'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.roles_create', compact('permissions'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleStoreRequest $request)
    {
        $role = new Role;
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->color = $request->input('color');
        $role->save();

        // Attach permission to role
        if ($request->input('permission_id') != null) {
            foreach ($request->input('permission_id') as $key => $value) {
                $role->attachPermission($value);
            }
        }

        Toastr::success('Berhasil menambahkan role');
        return redirect()->route('roles.index');
    }

// Roles Delete Confirmation Page
    public function show($id)
    {
        //
//        try {
//            $role = Role::findOrFail($id);
//
//            $params = [
//                'title' => 'Delete Role',
//                'role' => $role,
//            ];
//
//            return view('admin.roles.roles_delete')->with($params);
//        } catch (ModelNotFoundException $ex) {
//            if ($ex instanceof ModelNotFoundException) {
//                return response()->view('errors.' . '404');
//            }
//        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $role_permissions = $role->permissions()->get()->pluck('id')->toArray();

        return view('admin.roles.roles_edit', compact('role', 'permissions', 'role_permissions'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->color = $request->input('color');
        $role->save();

        DB::table("permission_role")->where("permission_role.role_id", $id)->delete();
        // Attach permission to role
        foreach ($request->input('permission_id') as $key => $value) {
            $role->attachPermission($value);
        }

        Toastr::success('Berhasil mengubah role');
        return redirect()->route('roles.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        //$role->delete();
        $role->users()->sync([]); // Delete relationship data
        $role->permissions()->sync([]); // Delete relationship data

        $role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete

        Toastr::success('Berhasil menghapus role');
        return redirect()->route('roles.index');
    }
}
