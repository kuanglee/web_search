<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
    protected $table = 'loaitin';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'idTheLoai',
        'Ten',
        'TenKhongDau',
        'created_at',
        'updated_at'
    ];

    public function tintuc()
    {
        return $this->hasMany('App\Models\TypeNew', 'idLoaiTin', 'id');
    }

    public function theloai()
    {
        return $this->belongsTo('App\Models\TheLoai', 'idTheLoai', 'id');
    }

}
