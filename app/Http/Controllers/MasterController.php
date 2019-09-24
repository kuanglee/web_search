<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeNew;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use App\Models\User;

class MasterController extends Controller
{
    public function index(){
        $countCategories = TheLoai::all()->count();
        $countTypeNews = LoaiTin::all()->count();
        $countUsers = User::all()->count();
        $countNews = TypeNew::all()->count();
        return view('admin.home' , compact('countCategories' , 'countNews' , 'countTypeNews' , 'countUsers'));
    }
}
