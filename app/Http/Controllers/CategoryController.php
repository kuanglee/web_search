<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;

class CategoryController extends Controller
{
    //
    public function listCategory(){
        $category = Category::all();
        return view('admin.category.list',['category'=>$category]);
    }

    public function add_ajax(Request $request){
        $this->validate($request,['Ten' => 'required',
                'TenKhongDau' => 'required']
        );
        $categorys = Category::all();
        $category = new Category;
        $category->Ten = $request->Ten;
        $category->TenKhongDau = $request->TenKhongDau;
        $category->save();
        return redirect()->back()->with('thongbao' , "Add success");

    }

    public function edit_ajax(Request $request){
//        dd($request);
        $category = Category::find($request->id);
        $this->validate($request , [
            'Ten'=> 'required',
            'TenKhongDau' => 'required'
        ]);
        $category->Ten = $request->Ten;
        $category->TenKhongDau = $request->TenKhongDau;
        $category->save();
        return redirect()->back()->with('thongbao' , "Edit success");
    }

    public function delete(Request $request){
        Category::where('id' , $request->id)->delete();
        return redirect()->back()->with('thongbao' , ' Delete Success');
    }
}
