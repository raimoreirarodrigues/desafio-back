<?php

namespace App\Services;

use App\Models\City;
use Exception;

class CityService{
  
    public function list(array $data){
        try{
           $query = City::query();
           return $query->where('uf',$data['uf'])->orderBy('name','asc')->get();
        }catch(Exception $e){
          throw $e;
        }
    }
}