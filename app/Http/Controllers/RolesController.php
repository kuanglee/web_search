<?php

namespace App\Http\Controllers;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\User;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Permission;

class RolesController extends Controller
{

    protected $role;
    protected $permission;
    protected $user;

    public function __construct(Role $role, Permission $permission, User $user)
    {
        $this->role = new RoleRepository($role);
        $this->permission = new RoleRepository($permission);
        $this->user = new UserRepository($user);
    }

    public function index()
    {
        $roles = $this->role->getRole();
        return view('admin/roles/list', compact('roles'));
    }

    public function create()
    {
        $listPermission = $this->permission->getPermission();
        $listUser = $this->user->all();

        return view('admin.roles.add', compact('listPermission', 'listUser'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $role = new Role;
            $roleCreate = $role->create($request->all());
            $this->role->createPermissionRole($request->listPermissionId, $roleCreate->id);
//            $this->role->createUserRole($request->listUserId, $roleCreate->id);
            DB::commit();
            return Redirect::route('admin.roles.index')->with('success', 'The Role has been saved.');
        } catch (Exception $exception) {
            DB::rollBack();
            return Redirect::back()->with('error', 'The Role could not be saved. Please, try again!');
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $roles = $this->role->findOrFail($id);
        $listPermission = $this->permission->getPermission();
        $listUser = $this->user->all();

        $listRoleUser = $this->role->getListRoleUser($id);
        $listPermissionRole = $this->role->getListRolePermission($id);

        return view('admin.roles.edit', compact('roles', 'id', 'listUser', 'listPermission' , 'listRoleUser' , 'listPermissionRole'));
    }


    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $role = $this->role->findOrFail($id);
            $role->users()->detach();
//            $role->permissions()->detach();
            DB::table('role_permission')->where('role_id', $id)->delete();
            $role->delete($id);
            DB::commit();
            return Redirect::route('admin.roles.index')->with('success', 'The Role has been deleted.');

        } catch (Exception $exception) {
            DB::rollBack();
            return Redirect::back()->with('error', 'The Role could not be saved. Please, try again!');
        }
    }
}
