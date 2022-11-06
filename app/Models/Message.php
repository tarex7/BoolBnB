<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable =
    [
      'sender_email',
      'sender_name',
      'text',
      'flat_id',
      'object'
      
    ];
    public function flat() {
        return $this->belongsTo('App\Models\Flat');
    }
}
