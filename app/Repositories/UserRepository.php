<?php

namespace App\Repositories;

use http\Client\Curl\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use JasonGuru\LaravelMakeRepository\Repository\RepositoryContract;

//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function model()
    {
        //return YourModel::class;
    }

    public function getRole()
    {
        return $this->model->all();
    }

    public function all(array $columns = ['*'])
    {
        return $this->model->all()->sortByDesc("id");
    }

    public function getUser($id)
    {
        return $this->model->find($id);
    }

    public function getUserProfile()
    {
        $userId = Auth::user()->id;
        $user = DB::table('users')->LeftJoin('profile_users' , 'profile_users.id' , 'users.id')->where('profile_users.user_id' , '=' , $userId)->get()->toArray();
//        dd($user);
        return $user;

    }


}
