<?php

namespace App\Http\Controllers\Admin;
use App\Models\Flat;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
         //return view('admin.home');
        $flats = Flat::all()->where('user_id', Auth::id());
        $services = Service::select('id', 'label', 'icon')->get();

        return view('admin.flats.index', compact('flats', 'services'));
    }
}
