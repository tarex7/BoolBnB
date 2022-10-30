<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SponsorshipResource;

class SponsorshipController extends Controller
{
    public function index(Request $request,){
        
        $sponsorships = Sponsorship::all();
        /* return SponsorshipResource::collection($sponsorships); */
        return view('admin.sponsorships.index', compact('sponsorships'));
    }


    public function show(Request $request)
    {
        
        return view('admin.sponsorships.show');

    }
}