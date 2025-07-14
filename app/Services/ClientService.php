<?php

namespace App\Services;

use App\Models\City;
use App\Models\Client;
use App\Models\Method;
use Exception;

class ClientService{
  
    public function list(array $data){
        try{
           $query = Client::query();
          
           if(isset($data['document'])){
             $document = UtilService::removEspecialCharacter($data['document']);
             $query = $query->where('document',$document);
           }

           if(isset($data['name'])){
             $query = $query->where('name','like','%'.$data['name'].'%');
           }

           if(isset($data['gender'])){
             $query = $query->where('gender',$data['gender']);
           }
           
            if(isset($data['address'])){
             $query = $query->where('address','like','%'.$data['address'].'%');
           }

           if(isset($data['uf']) && $data['uf'] != 'all'){
             $cities_id = City::where('uf',$data['uf'])->pluck('id');
             if(count($cities_id) > 0){
                $query = $query->whereIn('city_id',$cities_id);
             }
           }

           if(isset($data['city']) && $data['city'] != 'all'){
             $city = City::where('id',$data['city'])->first();
             if($city){
                $query = $query->where('city_id',$city->id);
             }
           }

           return $query->orderBy('name','asc')->paginate(10);

        }catch(Exception $e){
          throw $e;
        }
    }

    public function store(array $data){
        try{
           $data['city_id'] = $data['city'];
           $client =  Client::create($data);
           return $client->refresh();
        }catch(Exception $e){
            throw $e;
        }
    }
}