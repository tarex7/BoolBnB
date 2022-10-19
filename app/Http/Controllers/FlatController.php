<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flats = Flat::all();
        $services = Service::select('label','icon')->get();

        return view('registered_user.flats.index', compact('flats','services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $flats = Flat::all();

        $services = Service::select('label','icon')->get();


        return view('registered_user.flats.create',compact('flats','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $flat = new Flat();
        $flat->fill($data);
        $flat->user_id = Auth::id();

        $flat->save();

        //return redirect()->route('registered_user.show', $flat);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function show(Flat $flat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function edit(Flat $flat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flat $flat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flat $flat)
    {
        //
    }
}
