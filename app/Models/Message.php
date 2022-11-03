<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function flat() {
        return $this->belongsTo('App\Models\Flat');
    }

    public function getDate($data) {

     return $data->format('d-m-Y');

    }

    public function getTime($data) {

        return $data->format('H:m:s');



    }

}
