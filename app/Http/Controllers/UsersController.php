<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    private $user;
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->model = new UserRepository($user);
        $this->role = new RoleRepository($role);

    }

    public function index()
    {
        $users = $this->model->all();
        return view('admin.users.list', compact('users'));
    }

    public function store(UserRequest $request)
    {
        if ($request->password == $request->confirm_password) {
            try {
                DB::beginTransaction();
                $user = new User;
                $userCreate = $user->create($request->all());
                $this->role->createRoleUser($request->listRoleId, $userCreate->id);
                DB::commit();
                return Redirect::route('admin.users.index')->with('success', 'The User has been saved.');
            } catch (Exception $exception) {
                DB::rollBack();
                return Redirect::back()->with('error', 'The User could not be saved. Please, try again!');
            }
        } else {
            return Redirect::back()->with('error', 'Password and confirm password does not match .');
        }
    }

    public function edit(Request $request, $id)
    {
        $roles = $this->role->getRole();
        $users = $this->model->getUser($id);
        $listRoleUser = $this->role->getListSelectUser($id);
        return view('admin.users.edit', compact('users', 'id', 'roles', 'listRoleUser'));
    }


    public function create(Request $request)
    {
        $roles = $this->role->getRole();
        return view('admin.users.add', compact('roles'));

    }

    public function update(UserRequest $request, $id)
    {

        if ($request->password == $request->confirm_password) {
            try {
                DB::beginTransaction();
                $user = User::findOrFail($id);
                $user->update($request->all());
                $listRoleOld = $user->roles()->allRelatedIds()->toArray();
                $user->roles()->detach($listRoleOld);
                $user->roles()->attach($request->listRoleId);
                DB::commit();
                return Redirect::route('admin.users.index')->with('success', 'The Users has been saved.');
            } catch (Exception $exception) {
                DB::rollBack();
                return Redirect::back()->with('error', 'The Users could not be saved. Please, try again!');
            }
        } else {
            return Redirect::back()->with('error', 'Password and confirm password does not match .');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->findOrFail($id);
            $user->roles()->detach();
//            $role->permissions()->detach();
            DB::table('role_user')->where('user_id', $id)->delete();
            $user->delete($id);
            DB::commit();
            return Redirect::route('admin.users.index')->with('success', 'The Users has been deleted.');

        } catch (Exception $exception) {
            DB::rollBack();
            return Redirect::back()->with('error', 'The Users could not be saved. Please, try again!');
        }
    }


}
