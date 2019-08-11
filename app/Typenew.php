<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typenew extends Model
{
    //
    protected $table = "typenew";

    public function theloai(){
        return $this->belongsTo('App\Category','idCategory','id');
    }

//    public function tintuc(){
//        return $this->hasMany('App\TinTuc','idLoaiTin','id');
//    }
}
