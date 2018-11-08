<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dt_auth extends Model
{
    protected $table = 'dt_auth';
    protected $fillable = ['user_id', 'route_id', 'update_at', 'created_at'];
}
