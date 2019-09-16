<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeNew extends Model
{
    protected $table = 'type_news';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'TieuDe',
        'TieuDeKhongDau',
        'TomTat',
        'NoiDung',
        'Hinh',
        'SoLuotXem',
        'idLoaiTin',
        'created_at',
        'updated_at'
    ];

    public function loaitin(){
        return $this->belongsTo('App\Models\LoaiTin' , 'idLoaiTin' , 'id');
    }
}
