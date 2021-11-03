<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Opd;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
//        $this->middleware('role:users');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.users_list', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        $opds = Opd::pluck('deskripsi', 'id');

        return view('admin.users.users_create', compact('roles', 'opds'));
    }

    // Store New User
    public function store(UserStoreRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $role = Role::find($request->input('role_id'));

        $user->attachRole($role);

        Toastr::success('Berhasil menambahkan user');
        return redirect()->route('users.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
//        try {
//            $user = User::findOrFail($id);
//
//            $params = [
//                'title' => 'Confirm Delete Record',
//                'user' => $user,
//            ];
//
//            return view('admin.users.users_delete')->with($params);
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
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::with('permissions')->get();

        return view('admin.users.users_edit', compact('user', 'roles'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        // Update role of the user
        $roles = $user->roles;
        foreach ($roles as $key => $value) {
            $user->detachRole($value);
        }
        $role = Role::find($request->input('role_id'));
        $user->attachRole($role);

        Toastr::success('Berhasil mengubah user');
        return redirect()->route('users.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $roles = $user->roles;

        foreach ($roles as $key => $value) {
            $user->detachRole($value);
        }

        $user->delete();

        Toastr::success('Berhasil menghapus data');
        return redirect()->route('users.index');
    }
}
