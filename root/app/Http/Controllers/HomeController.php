<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $hotels = Hotel::all();
        return view('welcome',compact('hotels'));
    }
    public function index()
    {
        $hotel = Hotel::paginate(5);
        return view('home',compact('hotel'));
    }
    public function cari(Request $request)
    {
        $cari = $request->get('hotel');
        $hotel = Hotel::where('nama', 'LIKE', '%'.$cari.'%')->paginate(5);
        return view('home',compact('hotel'));
    }
    public function add()
    {
        return view('add');
    }
    public function tambah(Request $request)
    {
        $input = $request->all();
        $hotel = Hotel::create($input);
        return redirect('home');
    }
    public function lihat($id)
    {
        $hotel = Hotel::find($id);
        return view('lihat',compact('hotel'));
    }
    public function hapus($id)
    {
        $hotel = Hotel::find($id);
        $hotel->delete();
        return back();
    }
}
