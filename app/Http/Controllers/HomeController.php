<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = DB::table('categories')->count('id');
        $item = DB::table('items')->count();
        $offer = DB::table('offers')->count();
        $extras = DB::table('extras')->count();
        $user = DB::table('users')->count();
        $desc = DB::table('descriptions')->count();
        $compo = DB::table('compo_offers')->count();
        return view('home',compact('category','item','offer','user','extras','desc','compo'));
    }
}
