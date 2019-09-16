<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('login');
    }

    public function Switcher_Language(Request $request, $lang)
    {
        Session::put('locale', $lang);
        return redirect::back();
    }

}
