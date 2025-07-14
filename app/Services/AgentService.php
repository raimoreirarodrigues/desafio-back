<?php

namespace App\Services;

use App\Models\Agent;
use App\Models\AgentCity;
use Exception;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class AgentService{
  
    public function list(array $data){
        try{
           $query = Agent::query();
          
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
           return $query->orderBy('name','asc')->paginate(10);

        }catch(Exception $e){
          throw $e;
        }
    }

    public function store(array $data){
        try{
           $agent =  Agent::create($data);
           return $agent->refresh();
        }catch(Exception $e){
            throw $e;
        }
    }

    public function getAgent($id){
      try{
        $agent = Agent::find($id);
        if(is_null($agent)){
          throw new Exception('Representante não identificado');
        }

        return $agent;
      }catch(Exception $e){
        throw $e;
      }
    }

     public function update(Agent $agent, array $data){
        try{
           $agent->update($data);
           return $agent->refresh();
        }catch(Exception $e){
            throw $e;
        }
    }

    public function delete(Agent $agent){
        try{
          $agent->delete();
        }catch(Exception $e){
            throw $e;
        }
    }

     public function citiesAgent(Agent $agent){
        try{
          return AgentCity::with(['city'])->where('agent_id',$agent->id)->get();
        }catch(Exception $e){
            throw $e;
        }
    }

    public function storeCityAgent(Agent $agent,$id_city){
        try{
           //Verificar se representante já está associado à cidade
            $city_agent = AgentCity::where('agent_id',$agent->id)->where('city_id',$id_city)->first();
            if($city_agent){
              throw new ConflictHttpException('Cidade já associada ao representante');
            }
           AgentCity::create([
              'agent_id'=>$agent->id,
              'city_id'=>$id_city
           ]);
        }catch(ConflictHttpException $e){
            throw $e;
        }catch(Exception $e){
            throw $e;
        }
    }

     public function deleteCityAgent($id_city_agent){
        try{
           $city_agent = AgentCity::find($id_city_agent);
           if($city_agent){
            $city_agent->delete();
           }
        }catch(Exception $e){
            throw $e;
        }
    }
}