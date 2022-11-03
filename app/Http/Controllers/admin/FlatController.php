<?php

namespace App\Http\Controllers\admin;

use App\Models\Flat;
use App\Models\Message;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FlatController extends Controller

// VALDIAZIONE FLATS
{

    protected $validationFlat = [

        'title' => 'required|string|min:5|max:50|',
        'description' => 'required|string',
        'image' => 'nullable|image| mimes:jpeg,jpg,png,webp',
        //ADDRESS AGGIUNGERE
        'price_per_day' => 'required|numeric|min:1|max:3000',
        'room_number' => 'required|numeric|min:1|max:50',
        'bed_number' => 'required|numeric|min:1|max:10',
        'bathroom_number' => 'required|numeric|min:1|max:10',
        'square_mt' => 'required|numeric|min:5|max:5000',

    ];

    protected $validationFlatMessage =
    [
        //TITLE
        'title.required' => 'Il titolo è obbligatorio',
        'title.min' => 'Il titolo deve avere almeno :min caratteri',
        'title.max' => 'Il titolo deve avere almeno :max caratteri',
        // 'title.unique' => "Esiste già un post dal titolo $request->title",

        //DESCRIPTION
        'description.required' => "La descrizione dell'appartamento è obbligatoria",

        // IMAGE
        'image.image' => "Il file caricato non è di tipo immagine",
        'image.mimes' => "Le immagini ammesse sono solo in formato .jpeg, .jpg o .png",

        //ADDRESS
        // 'address.required' => 'Questo è un parametro obbligatorio',

        // PRICE FOR DAY
        'price_per_day.required' => 'Inserire un prezzo',
        'price_per_day.numeric' => 'Questo campo deve essere un numero',
        'price_per_day.min' => 'Il prezzo per notte può essere minimo :min',
        'price_per_day.max' => 'Il prezzo per notte può essere massimo :max',

        //ROOM_NUMBER
        'room_number.required' => 'Inserire la quantità di bagni disponibili ',
        'room_number.numeric' => 'Questo campo deve essere un numero',
        'room_number.min' => 'Il numero delle stanze devono essere almeno :min',
        'room_number.max' => 'Il numero delle stanze posssono essere massimo :max',

        //BATHROOM_NUMEBER
        'bathroom_number.required' => 'Inserire la quantità di bagni disponibili',
        'bathroom_number.numeric' => 'Questo campo deve essere un numero',
        'bathroom_number.min' => 'Il numero dei bagni devono essere almeno :min',
        'bathroom_number.max' => 'Il numero dei bagni possono essere massimo :max',

        //BED_NUMBER
        'bed_number.required' => 'Inserire la quantità di letti disponibili',
        'bed_number.numeric' => 'Questo campo deve essere un numero',
        'bed_number.min' => 'Il numero dei letti devono essere essere almeno :min',
        'bed_number.max' => 'Il numero dei letti possono essere massimo :max',

        //SQUARE_MT
        'square_mt.required' => "Inserire la grandezza dell'appartamento",
        'square_mt.numeric' => 'Questo campo deve essere un numero',
        'square_mt.min' => 'I metri quadri devono essere almeno :min',
        'square_mt.max' => 'I metri quadri possono essere massimo :max',

    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flats = Flat::all()->where('user_id', Auth::id());
        $services = Service::select('id', 'label', 'icon')->get();

        return view('admin.flats.index', compact('flats', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //                                       
    {

        $flats = Flat::all();
        $flat = new Flat;
        $services = Service::select('id', 'label', 'icon')->get();
        $services_ids = [];

        return view('admin.flats.create', compact('flat', 'flats', 'services', 'services_ids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // VALIDAZIONE
        $request->validate($this->validationFlat, $this->validationFlatMessage);

        $data = $request->all();
        $flat = new Flat();
        $flat->fill($data);
        $flat->user_id = Auth::id();

        //VISIBLE
        $flat->visible = array_key_exists('visible', $data);

        // IMAGE
        if (array_key_exists('image', $data)) {
            $image_url = Storage::put('flat_images', $data['image']);
            $flat->image = $image_url;
        }

        $flat->save();





        if (array_key_exists('services', $data)) {

            $flat->services()->attach($data['services']);
        }

        return redirect()->route('admin.flats.show', $flat)->with('message', "Appartamento creato con successo")->with('type', 'success');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Flat $flat)
    {
        if($flat->user_id != Auth::id()) return abort('404');

        $services = Service::select('id', 'label', 'icon')->get();
        $messages = Message::where('flat_id','=', $flat->id)->get();

        return view('admin.flats.show', $flat, compact('flat', 'services','messages'));

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
        if ($flat->user_id !== Auth::id()) {
            return redirect()->route('admin.flats.index')
                ->with('message', 'Non sei Autorizzato a modificare questo appartamento')
                ->with('type', 'warning');
        }
        $services = Service::select('id', 'label', 'icon')->get();

        // SERVICE_IDS
        $services_ids = $flat->services->pluck('id')->toArray();

        $prev_services = $flat->services->pluck('id')->toArray();
        return view('admin.flats.edit', compact('flat', 'services', 'services_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Flat $flat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flat $flat)
    { // VALIDAZIONE
        $request->validate($this->validationFlat, $this->validationFlatMessage);

        $data = $request->all();

        $flat->user_id = Auth::id();

        if (array_key_exists('services', $data)) {

            $flat->services()->sync($data['services']);
        }

        //VISIBLE
        $data['visible'] = array_key_exists('visible', $data);

        // IMAGE
        if (array_key_exists('image', $data)) {
            $image_url = Storage::put('flat_images', $data['image']);
            $flat->image = $image_url;
        }

        $flat->update($data);

        return redirect()->route('admin.flats.show', $flat)->with('message', "Appartamento modificato con successo")->with('type', 'success');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flat $flat)
    {
        if ($flat->user_id !== Auth::id()) {
            return redirect()->route('admin.flats.index')
                ->with('message', "Non sei autorizzato ad eliminare questo appartamento")
                ->with('type', "warning");
        }
        $flat->services()->detach();
        $flat->messages()->delete();
        $flat->views()->delete();

        $flat->delete();
        return redirect()->route('admin.flats.index')->with('message', "Appartamento eliminato con successo")->with('type', 'success');;
    }

    //TOGGLE
    public function toggle(Flat $flat)
    {
        $flat->visible = !$flat->visible;

        $status = $flat->visible ? 'pubblicato' : 'rimosso';
        $flat->save();


        return redirect()->route('admin.flats.index')->with('message', "Appartamento $status con successo")->with('type', 'success');
    }
}
