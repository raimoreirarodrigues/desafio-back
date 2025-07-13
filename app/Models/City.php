<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class City extends Model
{
    use Notifiable,SoftDeletes;
    
    protected $table            = 'cities';

    protected $fillable         = ['name','uf'];

  
}
