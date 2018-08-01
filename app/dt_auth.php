<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dt_auth extends Model
{
    public function routes(){
        return $this->belongsTo('dt_routes');
    }
}
