<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Carbon\Carbon;

class CategorysController extends Controller
{
    protected $category;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $listCategorys = TheLoai::all();
        return view('admin.theloai.list', compact('listCategorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_date = Carbon::now('Asia/Ho_Chi_Minh');
//        $this->validate($request , [
//            'Name' => 'required'
//        ]);
        try {
            DB::beginTransaction();

            $nameDeleteSpace = preg_replace('/\s+/', '-', $request->Name);
            DB::table('categorys')->insert([
                'Name' => $request->Name,
                'Unmarker_name' => $nameDeleteSpace,
                'updated_at' => $current_date,
                'created_at' => $current_date
            ]);
            DB::commit();
            return Redirect::route('admin.categorys.index')->with('success', 'The Categorys has been saved.');


        } catch (Exception $exception) {
            DB::rollBack();
            return Redirect::back()->with('error', 'The Categorys could not be saved. Please, try again!');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    public function updateAjax(Request $request)
    {
        $current_date = Carbon::now('Asia/Ho_Chi_Minh');
        try {
            DB::beginTransaction();

            $nameDeleteSpace = preg_replace('/\s+/', '-', $request->Name);
            $data = $request->all();
            $data['Unmarker_name'] = $nameDeleteSpace;
            $categorys = TheLoai::findOrFail($request->id);
            $categorys->update($data);
            $categorys->save();
            DB::commit();
            return Redirect::route('admin.categorys.index')->with('success', 'The Categorys has been saved.');


        } catch (Exception $exception) {
            DB::rollBack();
            return Redirect::back()->with('error', 'The Categorys could not be saved. Please, try again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $theloai = TheLoai::findOrFail($id);
            $theloai->tintuc()->delete();
            $theloai->loaitin()->delete();
            $theloai->delete();
            return Redirect::back()->with('success', 'Delete category Succeess');
        } catch (ModelNotFoundException $e) {

            return Redirect::back()->with('error', 'The Shop could not be deleted. Please, try again.');
        }

    }
}
