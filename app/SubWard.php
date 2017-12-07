<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubWard extends Model
{
    protected $table = 'sub_wards';
    public function ward()
    {
    	return $this->belongsTo('App\Ward');
    }
    public function wardassignment(){
    	return $this->hasMany('App\WardAssignment');
    }
}
