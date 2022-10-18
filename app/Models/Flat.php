<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    //Relazione 1 to 1 con views
    public function flatViews() {
        return $this->hasOne('App\Models\View');
    }

    //Relazione 1 to many con views

    public function messages() {
        return $this->hasMany('App\Models\Message');
    }
}
