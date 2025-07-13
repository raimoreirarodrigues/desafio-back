<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use Notifiable,SoftDeletes;
    
    protected $table            = 'clients';

    protected $fillable         = ['document','name','birthday','gender','address','city_id'];

    public function city(){
      return $this->hasOne(City::class,'id','city_id');
    }
}
