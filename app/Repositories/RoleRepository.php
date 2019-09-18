<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Model;//use Your Model

/**
 * Class RoleRepository.
 */
class RoleRepository extends BaseRepository
{
    protected  $model;

    public function __construct(Model $model)
    {
        $this->model =$model;
    }

    public function getRole(){
        return $this->model->all();
    }

    public function getRoleEdit($id){

    }

    public function getPermission(){
        return $this->model->all();
    }

    public function getUser(){
        return $this->model->all();
    }

    public function createRoleUser($listRoleId , $idUser){
        foreach ($listRoleId as $roleId){
            DB::table('role_user')->insert(['user_id' => $idUser, 'role_id' => $roleId] );
        }
    }

    public function createPermissionRole($listPermission , $idRole){
        foreach ($listPermission as $permissionId){
            DB::table('role_permission')->insert(['role_id' => $idRole, 'permission_id' => $permissionId] );
        }
    }
    public function createUserRole($listUser , $idRole){
        dd($listUser);
        foreach ($listUser as $user){
            DB::table('role_user')->insert(['user_id' => $user, 'role_id' => $idRole] );
        }
    }

    public function getListRoleUser($idUser){

        return DB::table('role_user')->where('role_id' , $idUser)->pluck('user_id');

    }

    public function getListRolePermission($roleId){
        return DB::table('role_permission')->where('role_id' , $roleId)->pluck('permission_id');
    }

    public function getListSelectUser($roleId){
        return DB::table('role_user')->where('user_id' , $roleId)->pluck('role_id');

    }

    public function findOrFail($id){
        return $this->model->findOrFail($id);
    }

    public function model()
    {
        //return YourModel::class;
    }
}
