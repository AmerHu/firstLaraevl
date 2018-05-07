<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'img',
        'desc_id',
        'active',
        'require'
    ];
}
