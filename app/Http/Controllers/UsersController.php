<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Repositories\Repository\UserRepository;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->model = new UserRepository($user);

    }

    public function index()
    {
        $users = $this->model->all();
        return view('admin.users.list', compact('users'));
    }

    public function store(UserRequest $request)
    {
        if ($request->password == $request->confirm_password) {
//            dd($request->password);
            try {
                DB::beginTransaction();
                $user = new User;
                $user->create($request->all());
                DB::commit();
                return Redirect::route('admin.users.index')->with('success', 'The Categorys has been saved.');


            } catch (Exception $exception) {
                DB::rollBack();
                return Redirect::back()->with('error', 'The Categorys could not be saved. Please, try again!');
            }
        }
        else {
//            dd($request->confirm_password);
            return Redirect::back()->with('error', 'Password and confirm password does not match .');
        }

    }

    public
    function create(Request $request)
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
        return view('admin.users.add');

    }


}
