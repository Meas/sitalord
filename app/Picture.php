<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable=[
    'name', 
    'gallery',
    ];

    public function Article()
    {
    	return $this->belongsTo('App\Article');
    }

}
