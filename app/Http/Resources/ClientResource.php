<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            =>$this->id,
            'document'      =>$this->document,
            'name'          =>$this->name,
            'birthday'      =>$this->birthday,
            'gender'        =>$this->gender,
            'address'       =>$this->address,
            'uf'            =>$this->city->uf,
            'city'          =>$this->city->name
        ];
    }
}
