<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{


    protected $table = 'categorys';

    public $timestamps = true;

    public function loaitin()
    {
        return $this->hasMany('App\Models\LoaiTin', 'idTheLoai', 'id');
    }

    public function tintuc()
    {
        return $this->hasManyThrough('App\Models\TypeNew', 'App\Models\LoaiTin', 'idTheLoai', 'idLoaiTin', 'id');
    }

    protected $fillable = [
        'id',
        'Name',
        'Unmarker_name',
        'created_at',
        'updated_at'
    ];
}
