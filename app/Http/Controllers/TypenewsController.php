<?php

namespace App\Http\Controllers;

use App\Models\LoaiTin;
use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\TypeNew;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class TypenewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = TheLoai::all();
        $loaitin = LoaiTin::all();
        $theloai = TypeNew::findOrFail(2);
        $typenews = TypeNew::orderBy('id','DESC')->get();

        return view('admin/typenew/list', compact('typenews', 'categorys' , 'loaitin'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $current_date = Carbon::now('Asia/Ho_Chi_Minh');
        try {
            DB::beginTransaction();
            $tenKhongDau = $this->utf8tourl($request->TieuDe);
            $data = $request->all();
            $data['TieuDeKhongDau'] = $tenKhongDau;
            $typenews = new TypeNew;
            $typenews->create($data);
            DB::commit();
            return Redirect::route('admin.typenews.index')->with('success', 'The typenews has been saved.');
        } catch (Exception $exception) {
            DB::rollBack();
            return Redirect::back()->with('error', 'The Typenews could not be saved. Please, try again!');
        }
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

    public function updateAjax(Request $request)
    {
        $current_date = Carbon::now('Asia/Ho_Chi_Minh');
        try {
            DB::beginTransaction();

            $tenKhongDau = $this->utf8tourl($request->TieuDe);
            $data = $request->all();
            $data['TieuDeKhongDau'] = $tenKhongDau;
            $typenews = TypeNew::findOrFail($request->id);

            $typenews->update($data);
            $typenews->save();
            DB::commit();
            return Redirect::route('admin.typenews.index')->with('success', 'The Type new has been saved.');


        } catch (Exception $exception) {
            DB::rollBack();
            return Redirect::back()->with('error', 'The Type new could not be saved. Please, try again!');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        DB::table('type_news')->where('id', "=", $id)->delete();
        return Redirect::back()->with('success', "Delete Type New Succeess");
    }
}
