<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public $timestamps = true;

    public $fillable = [
        'id',
        'name',
        'email',
        'address',
        'password'

    ];

    protected $hidden = [
        'password',
        '_token',
        'remember_token'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] =bcrypt($value);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);

    }
}
