<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tamouser extends Model
{
    protected $table = 'dt_users';
    protected $connection = 'tamo';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

}
