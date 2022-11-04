<?php

namespace App\Http\Controllers\api;

use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SponsorshipController extends Controller
{
    public function index(Request $request) {

        $sponsorships = Sponsorship::all();

        return response()->json($sponsorships,200);
    }
}
