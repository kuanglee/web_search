<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dictionary;
use DB;
use Illuminate\Support\Facades\Log;

class DictionaryController extends Controller
{

    public function getView()
    {
        return view('admin.dictionary.addDictionary');
    }

    public function postAddDictionary(Request $request)
    {
        $dictionary = new Dictionary;
        $dictionary->japanese = $request->dic_japanese;
        $dictionary->vietnamese = $request->dic_vietnamese;
        $dictionary->english = $request->dic_english;
        $dictionary->status = "";
        $dictionary->save();
        return redirect('admin/dictionary/list')->with('thongbao', 'Add success!');
    }

    public function getViewDictionary()
    {
        $dictionarty = Dictionary::all();
        return view('admin.dictionary.listDictionary', ['dictionary' => $dictionarty]);
    }

    public function getViewSearchDictionary()
    {
        return view('admin.dictionary.searchDictionary');
    }

    public function getResultSearch($id, $key)
    {
        $data = DB::table('dictionary')->find($id);
        //Log::debug("gia tri key " . $key);
//        dd($data);
        return view('admin.dictionary.resultSearch', ['data' => $data, 'key' => $key]);
    }

    function select(Request $request)
    {
        $select_language = $request->get('id');
        Log::debug(" gias tri cua test select" . $select_language);
    }


    function deleteDictionary($id)
    {
        $dictionary = Dictionary::find($id);
        $dictionary->delete();
        return redirect('admin/dictionary/list')->with('thongbao', 'Delete Success');
    }

    function getEditDictionary($id)
    {
        $data = Dictionary::find($id);
        //return redirect('admin/dictionary/add',['dictionary'=>$dictionary]);
        return view('admin.dictionary.addDictionary', ['data' => $data]);
    }

    function postEditDictionary(Request $request, $id)
    {
        $dictionary = Dictionary::find($id);
        $dictionary->japanese = $request->dic_japanese;
        $dictionary->vietnamese = $request->dic_vietnamese;
        $dictionary->english = $request->dic_english;
        $dictionary->save();
        return redirect('admin/dictionary/list')->with('thongbao', 'Edit success!');
    }




function fetch(Request $request)
{
    $select_language = $request->get('id');
    $translate_arr = array();
    if ($select_language == "vn-en") {
        $translate_arr = array("language" => "vietnamese", "key" => "1");
        Log::debug("gias tri tranlate : " . $translate_arr['language']);
    } elseif ($select_language == "vn-ja") {
        $translate_arr = array("language" => "vietnamese", "key" => "2");
    } elseif ($select_language == "ja-vn") {
        $translate_arr = array("language" => "japanese", "key" => "3");
    } elseif ($select_language == "ja-en") {
        $translate_arr = array("language" => "japanese", "key" => "4");
    } elseif ($select_language == "en-vn") {
        $translate_arr = array("language" => "english", "key" => "5");
    } elseif ($select_language == "en-ja") {
        $translate_arr = array("language" => "english", "key" => "6");
    }
    if ($select_language != null) {
        if ($request->get('query')) {
            $query = $request->get('query');
//                $data = DB::table('dictionary')
////                    ->where('japanese', 'LIKE', "%{$query}%")
////                    ->orWhere('vietnamese', 'LIKE', "%{$query}%")
////                    ->orWhere('english', 'LIKE', "%{$query}%")
////                    ->get();
            $data = DB::table('dictionary')
                ->where($translate_arr['language'], 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $id = $row->id;
                if ($translate_arr['language'] == "vietnamese") {

                    $output .= '<li><a href="admin/dictionary/ResultDictionary/' . $id . '/' . $translate_arr['key'] . '">' . $row->vietnamese . '</a></li>';
                } elseif ($translate_arr['language'] == "japanese") {

                    $output .= '<li><a href="admin/dictionary/ResultDictionary/' . $id . '/' . $translate_arr['key'] . '">' . $row->japanese . '</a></li>';
                } elseif ($translate_arr['language'] == "english") {

                    $output .= '<li><a href="admin/dictionary/ResultDictionary/' . $id . '/' . $translate_arr['key'] . '">' . $row->english . '</a></li>';
                }

            }
            $output .= '</ul>';

            echo $output;
        }


    }

}
}
