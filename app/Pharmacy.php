<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
class Pharmacy extends Authenticatable
{
    use Notifiable;

	protected $guard = 'pharmacy';
    protected $table = "Pharmacy";
     protected $fillable = [

        'id','Ph_Name','Ph_Owner','email','password', 'phone',
    ];
}
