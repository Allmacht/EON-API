<?php

namespace App\Http\Resources\ClientsPerWarehouse;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientsPerWarehouseResource extends JsonResource
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
            'warehouse_id' => $this->warehouse_id,
            '_link' => self::link($this->warehouse_id)
        ];
    }

    private function link(string $warehouse_id): string
    {
        return route('warehouses.id', ['warehouse' => $warehouse_id]);
    }
}
