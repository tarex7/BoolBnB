<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    public function flats() {
        return $this->belongsToMany('App\Models\Flat')->withPivot('');
    }
}
