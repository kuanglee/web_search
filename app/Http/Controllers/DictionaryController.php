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

    public function getViewSearchDictionary(){
        return view('admin.dictionary.searchDictionary');
    }

    public function getResultSearch($id){
        $data =  DB::table('dictionary')->find($id);
//        dd($data);
        return view('admin.dictionary.resultSearch' , ['data'=> $data]);
    }

    function select(Request $request){
        $select_language = $request->get('id');
        static::$select = $select_language;
        Log::debug(" gias tri cua test select" . $select_language);
    }


    function deleteDictionary($id){
        $dictionary = Dictionary::find($id);
        $dictionary->delete();
        return redirect('admin/dictionary/list')->with('thongbao','Delete Success');
    }

    function getEditDictionary($id){
        $data = Dictionary::find($id);
        //return redirect('admin/dictionary/add',['dictionary'=>$dictionary]);
        return view('admin.dictionary.addDictionary' , ['data'=> $data]);
    }

    function postEditDictionary(Request $request , $id){
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
          //  Log::debug(" fetch" . $this->test());


            Log::debug("khac nulll" . $request->get('id'));
         if ($select_language != null){
            if($request->get('query'))
            {
                $query = $request->get('query');
//                $data = DB::table('dictionary')
////                    ->where('japanese', 'LIKE', "%{$query}%")
////                    ->orWhere('vietnamese', 'LIKE', "%{$query}%")
////                    ->orWhere('english', 'LIKE', "%{$query}%")
////                    ->get();
                 $data = DB::table('dictionary')
                                    ->where($select_language, 'LIKE', "%{$query}%")
                                    ->get();
                $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
                foreach($data as $row)
                {
                    $id = $row->id;
                    if ($select_language == "vietnamese"){
                        Log::debug(" gias tri cua test : vietnam");
                        $output .= '<li><a href="admin/dictionary/ResultDictionary/'. $id .'">'.$row->vietnamese.'</a></li>';
                    }
                    elseif ($select_language == "japanese"){
                        Log::debug(" gias tri cua test : japoaneses");
                        $output .= '<li><a href="admin/dictionary/ResultDictionary/'. $id .'">'.$row->japanese.'</a></li>';
                    }
                    elseif ($select_language == "english"){
                        Log::debug(" gias tri cua test : english");
                        $output .= '<li><a href="admin/dictionary/ResultDictionary/'. $id .'">'.$row->english.'</a></li>';
                    }

                    //$output .= '<li><a href="admin/ResultDictionary/'. $id .'">'.$row->vietnamese.'&emsp;(' . $row->japanese . ')&emsp;'.'(' . $row->english . ')' .'</a></li>';


                }
                $output .= '</ul>';

                echo $output;
                //return view('autocomplete', ['dictionary' => $output]);
            }
        }
        //Log::debug(" gias tri cua test : " . $test);

    }
}
