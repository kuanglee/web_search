<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    //
    protected $table = 'categorys';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'Name',
        'Unmarker_name',
        'created_at',
        'updated_at'
    ];
}
