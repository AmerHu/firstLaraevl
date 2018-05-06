<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    public function extras()
    {
        return $this->belongsTo('App\items');
    }
    protected $fillable = [
        'name', 'price',
    ];

}
