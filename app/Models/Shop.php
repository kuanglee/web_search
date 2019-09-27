<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';

    public $timestamps = true;

    public $fillable = [
        'id',
        'name',
        'address',
        'description',
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
