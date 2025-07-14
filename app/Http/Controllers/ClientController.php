<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller{

    private $service;

    public function __construct(ClientService $service){
        $this->service = $service;
    }
    
    public function list(Request $request){
        try{
            $clients = $this->service->list($request->all());
             return response()->json([
              'data'            =>ClientResource::collection($clients),
              'last_page'       =>$clients->lastPage(),
              'total_itens'     =>$clients->total(),
              'current_page'    =>$clients->currentPage(),
              'has_page'        =>$clients->hasPages(),
              'per_page'        =>$clients->perPage()
           ],Response::HTTP_OK); 
        }catch(Exception $e){
            return response()->json(['error'=>'Falha ao listar clientes'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

     public function store(StoreClientRequest $request){
        try{
            $this->service->store($request->validated());
            return response()->json(['message'=>'Cliente cadastrado com sucesso!'],Response::HTTP_CREATED); 
        }catch(Exception $e){
            return response()->json(['error'=>'Falha ao listar clientes'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function edit(Request $request, $id){
        try{
            $client = $this->service->edit($id);
            $cities = $this->service->getCitiesByUfClient($client);
            return response()->json(['client'=>ClientResource::make($client),'cities'=>$cities],Response::HTTP_OK);
        }catch(Exception $e){
              return response()->json(['error'=>'Falha ao editar cliente'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
}
