<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable=[
    'name',
    'main',
    ];

    public function Article()
    {
    	return $this->belongsTo('App\Article');
    }

}
