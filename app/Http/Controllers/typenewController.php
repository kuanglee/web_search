<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Typenew;
use DB;

class typenewController extends Controller
{
    //
    public function listTypeNew()
    {
        $typenew = Typenew::all();
        $category = Category::all();
        return view('admin.newtypes.list', ['typenew' => $typenew , 'category' => $category]);
    }

    public function add_ajax(Request $request){
        $this->validate($request,['Ten' => 'required',
                'TenKhongDau' => 'required']
        );
//        dd($request);
        $typenew = Typenew::all();
        $typenew = new Typenew();
        $typenew->Ten = $request->Ten;
        $str = $request->Ten;
        $str2 =  $this->stripUnicode($str);
        $arr_str = explode( ' ', $str2 );
        $comma_separated = implode("-", $arr_str);
        $typenew->TenKhongDau = $comma_separated;
        $typenew->idCategory = $request->TenKhongDau;
        $typenew->save();
        return redirect()->back()->with('thongbao' , "Add success");

    }

    public function delete(Request $request)
    {
//        $str = "lê văn quang sinh năm 1997";
////        dd($this->stripUnicode($str));
//        $str2 =  $this->stripUnicode($str);
//        $arr_str = explode( ' ', $str2 );
//        $comma_separated = implode("-", $arr_str);
//        dd($comma_separated);

        Typenew::where('id', $request->id)->delete();
        return redirect()->back()->with('thongbao', ' Delete Success');
    }

    public function edit_ajax(Request $request){
//        dd($request);
        $typenew = Typenew::find($request->id);
        $this->validate($request , [
            'Ten'=> 'required',
            'TenKhongDau' => 'required'
        ]);
        $typenew->Ten = $request->Ten;
        $str = $request->Ten;
        $str2 =  $this->stripUnicode($str);
        $arr_str = explode( ' ', $str2 );
        $comma_separated = implode("-", $arr_str);
        $typenew->TenKhongDau = $comma_separated;
        $typenew->idCategory = $request->TenKhongDau;
        $typenew->idCategory = $request->TenKhongDau;
        $typenew->save();
        return redirect()->back()->with('thongbao' , "Edit success");
    }

    function stripUnicode($str)
    {
        if (!$str) return false;
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni) $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        return $str;
    }
}
