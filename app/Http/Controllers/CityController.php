<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CityService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller{

    private $service;

    public function __construct(CityService $service){
        $this->service = $service;
    }
    
    public function list(Request $request,$uf){
        try{
            $cities = $this->service->list(['uf'=>$uf]);
             return response()->json(['cities'=>$cities],Response::HTTP_OK); 
        }catch(Exception $e){
            return response()->json(['error'=>'Falha ao listar cidades'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
