<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flat;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Vedo solo i Flat Visibili
        $flats = Flat::where('visible', 1,'sponsorship')->orderBy('created_at', 'DESC')->get();

        $data = [
            'success' => true,
            'results' => $flats,
        ];
        return response()->json($data);
        return response()->json($flats);
    }

    public function sponsored(){
          
        $flats = Flat::where('is_sponsored', 1)->get();

        $data = [
            'success' => true,
            'results' => $flats,

        ];

        return response()->json($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $flat_lat_long = Flat::select(['latitude', 'longitude', 'id'])->find($id);

        if(!$flat_lat_long) return response('Not found', 404);
        return response()->json($flat_lat_long);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
