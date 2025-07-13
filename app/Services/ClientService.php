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

           if(isset($data['uf']) && $data['uf'] != 'all'){
             $city = City::where('uf',$data['uf'])->first();
             if($city){
                $query = $query->where('uf',$city->uf);
             }
           }

           if(isset($data['city']) && $data['city'] != 'all'){
             $city = City::where('name',$data['city'])->first();
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
           $client =  Client::create($data);
           return $client->refresh();
        }catch(Exception $e){
            throw $e;
        }
    }
}