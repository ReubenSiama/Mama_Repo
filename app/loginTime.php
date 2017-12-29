<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loginTime extends Model
{
    protected $table='login_times';
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
