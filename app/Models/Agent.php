<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Agent extends Model
{
    use Notifiable,SoftDeletes;
    
    protected $table            = 'representatives';

    protected $fillable         = ['document','name','birthday','gender','address'];

}
