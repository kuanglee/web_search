<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $table = 'roles';

    public $fillable = [
        'id',
        'name',
        'description',
        'display_name',
        'created_at',
        'updated_at'

    ];
    public $timestamp = true;


    public function users(){
        return $this->belongsToMany(User::class);
    }



    public function permissions(){
        return $this->belongsToMany(Permission::class , 'role_permission'  , 'role_id', 'permission_id');
    }


}
