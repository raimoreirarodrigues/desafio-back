<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class AgentCity extends Model
{
    use Notifiable,SoftDeletes;
    
    protected $table    = 'agent_cities';

    protected $fillable = ['agent_id','city_id'];

    public function agent(){
      return $this->hasOne(Agent::class,'id','agent_id');
    }

    public function city(){
      return $this->hasOne(City::class,'id','city_id');
    }
}
