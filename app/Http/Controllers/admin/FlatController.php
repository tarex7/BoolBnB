<?php

namespace App\Http\Controllers\admin;

use App\Models\Flat;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() ///////////////////////////////////////////////INDEX
    {
        $flats = Flat::all()->where('user_id', Auth::id());
        $services = Service::select('id','label','icon')->get();

        return view('admin.flats.index', compact('flats','services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //                                          CREATEEEEEE
    {

        $flats = Flat::all();
        $flat = new Flat;
        $services = Service::select('id','label','icon')->get();
        

        return view('admin.flats.create',compact('flat','flats','services'));
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

        if(array_key_exists('services', $data)) {

            $flat->services()->attach($data['services']);
        }

        return redirect()->route('admin.flats.show', $flat);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Flat $flat)
    {
       //$flat = Flat::select('id')->get();
        return view('admin.flats.show', $flat, compact('flat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Flat $flat)
    {
         //controllo che sia l'autore, se non lo è ridirigo sulla index
        //  if($post->user_id !== Auth::id()){
        //     return redirect()->route('admin.posts.index')
        //     ->with('message', 'Non sei Autorizzato a modificare questo post')
        //     ->with('type', 'warning');
        // }
        $services = Service::select('id', 'label', 'icon')->get();
        
        $prev_services = $flat->services->pluck('id')->toArray();
        return view('admin.flats.edit', compact('flat','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Flat $flat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flat $flat)
    {
        $data = $request->all();        
        
        $flat->user_id = Auth::id();       
        
        if(array_key_exists('services', $data)) {
            
            $flat->services()->sync($data['services']);
        }
        
        $flat->update($data);

        return redirect()->route('admin.flats.show', $flat);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flat $flat)
    {
        $flat->services()->detach();
       
        $flat->delete();

        return redirect()->route('admin.flats.index');


    }
}
