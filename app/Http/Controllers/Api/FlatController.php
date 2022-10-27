<?php

namespace App\Http\Controllers\Api;

use App\Models\Flat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

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
        $flats = Flat::where('visible', 1)->orderBy('created_at', 'DESC')->get();

        return response()->json($flats);
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


    public function search(Request $request)

    {
        $lat = $request->get('lat');
        $lon = $request->get('lon');
        $radius = $request->get('radius');

        $geometryList = [
            [
                'type' => 'CIRCLE',
                'position' => "$lat , $lon",
                'radius' => $radius,
            ]
        ];

        $filteredFlats = [];

        foreach ($filteredFlats as $flat) {
            $flatArray = [
                'poi' => [
                    'name' => $flat->title
                ],
                'address' => [
                    'freeformAddress' => $flat->address
                ],
                'position' => [
                    'lat' => $flat->latitude,
                    'lon' => $flat->longitude,
                ],
                'info' => [
                    'id' => $flat->id,
                ]
            ];
            array_push($flatList, $flatArray);
        };

        $flatList = [];

        $geometryList = json_encode($geometryList);
        $flatList = json_encode($flatList);

        $responseTomTom = Http::get("https://api.tomtom.com/search/2/geometryFilter.json?&key=OQPgwY4eUitV7IRklnutdiB8DVqRx8kG&geometryList=$geometryList&poiList=$flatList");

        $flatIds = [];
        $flatsFilteredArray = json_decode($responseTomTom);

        foreach ($flatsFilteredArray->results as $flat) {

            array_push($flatIds, $flat->info->id);
        }
       
        $response = Flat::whereIn('id', $flatIds)->orderByDesc('id')->get();

        return $response;
    }
}
