<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAgentRequest;
use App\Http\Requests\UpdateAgentRequest;
use App\Http\Resources\AgentResource;
use App\Services\AgentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AgentController extends Controller{

    private $service;

    public function __construct(AgentService $service){
        $this->service = $service;
    }
    
    public function list(Request $request){
        try{
            $representatives = $this->service->list($request->all());
             return response()->json([
              'data'            =>AgentResource::collection($representatives),
              'last_page'       =>$representatives->lastPage(),
              'total_itens'     =>$representatives->total(),
              'current_page'    =>$representatives->currentPage(),
              'has_page'        =>$representatives->hasPages(),
              'per_page'        =>$representatives->perPage()
           ],Response::HTTP_OK); 
        }catch(Exception $e){
            return response()->json(['error'=>'Falha ao listar representantes'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

     public function store(StoreAgentRequest $request){
        try{
            $this->service->store($request->validated());
            return response()->json(['message'=>'Representante cadastrado com sucesso!'],Response::HTTP_CREATED); 
        }catch(Exception $e){
            return response()->json(['error'=>'Falha ao cadastrar o representante'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function edit(Request $request, $id){
        try{
            $agent = $this->service->getAgent($id);
            return response()->json(['agent'=>AgentResource::make($agent)],Response::HTTP_OK);
        }catch(Exception $e){
              return response()->json(['error'=>'Falha ao editar representante'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateAgentRequest $request,$id){
        try{
            $agent = $this->service->getAgent($id);
            $this->service->update($agent,$request->validated());
            return response()->json(['message'=>'Representante atualizado com sucesso!'],Response::HTTP_OK); 
        }catch(Exception $e){
            return response()->json(['error'=>'Falha ao atualizar o representante'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(Request $request,$id){
        try{
            $agent = $this->service->getAgent($id);
            $this->service->delete($agent);
            return response()->json(['message'=>'Representante apagado com sucesso!'],Response::HTTP_OK); 
        }catch(Exception $e){
            return response()->json(['error'=>'Falha ao apagar o representante'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    } 

     public function citiesAgent(Request $request,$id){
        try{
            $agent  = $this->service->getAgent($id);
            $cities = $this->service->citiesAgent($agent);
            return response()->json(['agent'=>AgentResource::make($agent),'cities'=>$cities],Response::HTTP_OK);
        }catch(Exception $e){
            return response()->json(['error'=>'Falha ao listar cidades atreladas a um representante'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    } 

     public function storeCityAgent(Request $request,$id){
        try{
            $agent  = $this->service->getAgent($id);
            $this->service->storeCityAgent($agent,$request->id);
            return response()->json(['message'=>'Cidade associada ao representante com sucesso!'],Response::HTTP_CREATED); 
        }catch(Exception $e){
            return response()->json(['error'=>'Falha ao listar cidades atreladas a um representante'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    } 
}
