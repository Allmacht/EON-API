<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\ClientsPerWarehouse\ClientsPerWarehouseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            '_resource_state' => $this->_resource_state,
            'id' => $this->id,

            'general' => [
                'name' => $this->name,
                'slug' => $this->slug,
                'business_name' => $this->business_name,
                'phone' => $this->phone,
                'contact_name' => $this->contact_name,
                'service_phone' => $this->service_phone,
                'email' => $this->email,
                'rfid' => $this->rfid,
            ],

            'address' => [
                'country' => $this->country,
                'state' => $this->state,
                'city' => $this->city,
                'neighborhood' => $this->neighborhood,
                'street' => $this->street,
                'ext_number' => $this->ext_number,
                'int_number' => $this->int_number,
                'zipcode' => $this->zipcode,
            ],

            'warehouses' => ClientsPerWarehouseResource::collection($this->whenLoaded('warehouses'))
        ];
    }
}
