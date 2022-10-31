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
    public function index(Request $request)
    {
       
        $flats = Flat::with(['services'])
        ->where('visible', 1)
        ->orderBy('created_at', 'DESC')
        ->get();

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
    public function show()
    {
        $geometryList = [
            [
                'type' => 'CIRCLE',
                'position' => "40.55798 , 8.3222",
                'radius' => 20000,
            ]
        ];

        $flatList =
        [
            [
                'poi' => [
                    'name' => "Alghero Via Xx Settembre Lato Civico 112, Via 20 S"
                ],
                'address' => [
                    'freeformAddress' => "Alghero Via Xx Settembre Lato Civico 112, Via 20 Settembre, 07041 Alghero"
                ],
                'position' => [
                    'lat' => 40.5584600,
                    'lon' =>8.3194300,
                ],
                'info' => [
                    'id' => 10,
                ]
                ],
            [
                'poi' => [
                    'name' => "Viale Borsellino, 90145 Palermo"
                ],
                'address' => [
                    'freeformAddress' => "Viale Borsellino, 90145 Palermo"
                ],
                'position' => [
                    'lat' => 38.1332800,
                    'lon' =>13.3049700,
                ],
                'info' => [
                    'id' => 15,
                ]
            ]


        ];




        $responseTomTom = Http::get("https://api.tomtom.com");

        return response()->json($responseTomTom);

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






         $flats = Flat::all();

        //$flats = Flat::where('latitude','<', $lat)->get();
        




       // return response()->json($radius);


        $flatList = [];

        $geometryList = [
            [
                'type' => 'CIRCLE',
                'position' => "$lat , $lon",
                'radius' => $radius,
            ]
        ];

        foreach($flats as $flat) {
         
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

        $geometryList = json_encode($geometryList);
        $flatList = json_encode($flatList);
         
        $responseTomTom = Http::get("https://api.tomtom.com/search/2/geometryFilter.json?key=OQPgwY4eUitV7IRklnutdiB8DVqRx8kG&geometryList=$geometryList&poiList=$flatList");
        
       return response()->json($responseTomTom);
        

        // Get data filtered from TomTom and save ids in an Array
       

        

    }




    
}
