<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Braintree\Gateway;

class SponsorshipController extends Controller
{
    public function index(Request $request,Gateway $gateway)
    {
        $token_auto = $gateway->clientToken()->generate();
        $sponsorships = Sponsorship::all();

        $data = [
            'have_one' => true,
            'sponsorships' => $sponsorships,
            'tokenAutorization' => $token_auto,
            'flat' => $request->flat,
        ];

        return view('admin.sponsorships.index',  $data);
    }
}