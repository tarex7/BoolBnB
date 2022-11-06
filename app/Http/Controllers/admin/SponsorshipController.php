<?php

namespace App\Http\Controllers\admin;

use Braintree\Gateway;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SponsorshipController extends Controller
{
    public function index(Request $request,Gateway $gateway)

    {
        $sponsorships = Sponsorship::all();

        $token_auto = $gateway->clientToken()->generate();
        $sponsorships = Sponsorship::all();

        $data = [
            'have_one' => true,
            'sponsorships' => $sponsorships,
            'tokenAutorization' => $token_auto,
            'flat' => $request->flat,
        ];

        return view('admin.flats.sponsorships.index', $data);
    }


    public function show(Sponsorship $sponsorship){
        return view('admin.flats.sponsorships.show',$sponsorship);
    }
}

