<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{

    protected $fillable =
     [
       'title',
       'room_number',
       'bed_number',
       'bathroom_number',
       'square_mt',
       'description',
       'price_per_day',
       'address',
       'latitude',
       'longitude',
       'visible',
     ];

    //Relazione 1 to 1 con views
    public function flatViews() {
        return $this->hasOne('App\Models\View');
    }

    //Relazione 1 to many con views

    public function messages() {
        return $this->hasMany('App\Models\Message');
    }

    public function views() {
        return $this->hasMany('App\Models\View');
    }


    public function user() {
        return $this->belongsTo('App\User');
    }

    public function services() {
        return $this->belongsToMany('App\Models\Service');
    }

    public function sponsorships() {
        return $this->belongsToMany('App\Models\Sponsorship');
    }


}
