<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    public function index()

    {
        $sponsorships = Sponsorship::all();
        return view('admin.flats.sponsorships.index', compact('sponsorships'));
    }


    public function show(Sponsorship $sponsorship){
        return view('admin.flats.sponsorships.show',$sponsorship);
    }
}
