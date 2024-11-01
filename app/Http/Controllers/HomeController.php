<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

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
        $galleryItems = Gallery::all();

        return view('user.index',compact('galleryItems'));

        
    }

    public function landing()
    {
        
        return view('landing.index.');
    }

    public function profile()
    {
        return view('user.profile.index');
    }

}

