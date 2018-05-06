<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersType extends Model
{
    public function UsersType()
    {
        return $this->hasMany('App\User');
    }
}
