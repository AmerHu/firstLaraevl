<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    public function items()
    {
        return $this->belongsTo('App\Category');
    }

    public function extras()
    {
        return $this->hasMany('App\Extra');
    }


    protected $fillable = [
        'name',
        'price',
        'description',
        'img',
        'cate_id',
        'desc_id',
    ];

}