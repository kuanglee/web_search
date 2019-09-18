<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LoaiTinController extends Controller
{
    public function index()
    {
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.list', compact('loaitin'));
    }

    public function create()
    {
        $theloai = TheLoai::all();
        return view('admin.loaitin.add', ['theloai' => $theloai]);

    }

    function utf8convert($str)
    {
        if (!$str) return false;
        $utf8 = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ|Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($utf8 as $ascii => $uni) $str = preg_replace("/($uni)/i", $ascii, $str);
        return $str;
    }

    function utf8tourl($text)
    {
        $text = strtolower($this->utf8convert($text));
        $text = str_replace("ß", "ss", $text);
        $text = str_replace("%", "", $text);
        $text = preg_replace("/[^_a-zA-Z0-9 -] /", "", $text);
        $text = str_replace(array('%20', ' '), '-', $text);
        $text = str_replace("----", "-", $text);
        $text = str_replace("---", "-", $text);
        $text = str_replace("--", "-", $text);
        return $text;
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'Ten' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $tenKhongDau = $this->utf8tourl($request->Ten);
            $data = $request->all();
            $data['TenKhongDau'] = $tenKhongDau;
            $loaitin = new LoaiTin;
            $loaitin->create($data);
            DB::commit();
            return Redirect::route('admin.loaitin.index')->with('success', 'The Categorys has been saved.');


        } catch (Exception $exception) {
            DB::rollBack();
            return Redirect::back()->with('error', 'The Categorys could not be saved. Please, try again!');
        }
    }

    public function edit($id)
    {
        $theloai = TheLoai::all();
        $loaitin = loaitin::find($id);
        return view('admin.loaitin.edit',['loaitin'=>$loaitin,'theloai'=>$theloai , 'id'=>$id]);
    }


    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $tenKhongDau = $this->utf8tourl($request->Ten);
            $data = $request->all();
            $data['TenKhongDau'] = $tenKhongDau;
            $loaitin = LoaiTin::findOrFail($id);
            $loaitin->update($data);
            DB::commit();
            return Redirect::route('admin.loaitin.index')->with('success', 'The Categorys has been saved.');
        } catch (Exception $exception) {
            DB::rollBack();
            return Redirect::back()->with('error', 'The Categorys could not be saved. Please, try again!');
        }
    }

    public function destroy($id)
    {
        try {
            $loaitin = LoaiTin::findOrFail($id);
            $loaitin->tintuc()->delete();
            $loaitin->delete();
            return Redirect::back()->with('success', "Delete category Succeess");
        } catch (ModelNotFoundException $e) {
            return Redirect::back()->with('error', "Delete category Error");
        }
    }
}
