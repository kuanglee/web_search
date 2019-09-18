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

    public function __construct(User $user , Role $role)
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
                $this->role->createRoleUser($request->listRoleId , $userCreate->id );
                DB::commit();
                return Redirect::route('admin.users.index')->with('success', 'The User has been saved.');
            } catch (Exception $exception) {
                DB::rollBack();
                return Redirect::back()->with('error', 'The User could not be saved. Please, try again!');
            }
        }
        else {
            return Redirect::back()->with('error', 'Password and confirm password does not match .');
        }
    }

    public function edit(Request $request , $id){
        $roles = $this->role->getRole();
        $users = $this->model->getUser($id);
        $listRoleUser = $this->role->getListSelectUser($id);
//        dd($listRoleUser);
        return view('admin.users.edit' , compact('users' , 'id' , 'roles' , 'listRoleUser'));
    }


    public function create(Request $request)
    {
//        $role = new Role;
//        $role->name = 'God of War';
//        $role->display_name = "Quang";
//
//        $role->save();
//
//        $users = User::find([1, 2]);
////        dd($users);
//        $role->users()->attach($users);
        $roles = $this->role->getRole();
//        dd($roles);
        return view('admin.users.add' , compact('roles'));

    }

    public function destroy($id){

    }



}
