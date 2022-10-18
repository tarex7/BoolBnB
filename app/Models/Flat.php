<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    public function flatViews() {
        return $this->hasOne('App\Models\View');
    }
}
