<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompoOffers extends Model
{
    protected $fillable = [
        'name', 'price','img','desc_id',
    ];
}
