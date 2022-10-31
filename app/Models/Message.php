<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Message extends Model
{

    protected $fillable = ['sender_name', 'sender_email', 'text', 'object'];
    public function flat()
    {
        return $this->belongsTo('App\Models\Flat');
    }
}
