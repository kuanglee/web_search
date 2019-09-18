<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use JasonGuru\LaravelMakeRepository\Repository\RepositoryContract;

//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    protected  $model;
    public function __construct(Model $model)
    {
        $this->model =$model;
    }


    public function model()
    {
        //return YourModel::class;
    }

    public function getRole(){
        return $this->model->all();
    }

    public function all(array $columns = ['*'])
    {
        return $this->model->all()->sortByDesc("id");
    }

    public function getUser($id){
        return $this->model->find($id);
    }




}
