<?php

namespace App\Http\Resources\Warehouse;

use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseResource extends JsonResource
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
            'id' => $this->id,
            'name' => ucwords(strtolower($this->name)),
            'acronym' => $this->acronym($this->name),
            'slug' => $this->slug,
            'country' => $this->country,
            'state' => $this->state,
            'city' => $this->city,
            'neighborhood' => $this->neighborhood,
            'street' => $this->street,
            'ext_number' => $this->ext_number,
            'int_number' => $this->int_number,
            'zipcode' => $this->zipcode,
            'address' => "{$this->street} {$this->ext_number} {$this->neighborhood} {$this->ext_number}",
            'phone' => $this->phone,
            'map' => $this->map,
            'created_at' => $this->created_at->format('M d, Y h:i A'),
            'updated_at' => $this->updated_at->format('M d, Y h:i A'),
        ];
    }

    /**
     ** Starting from the name, an acronym is obtained
     *
     * @param  string  $text
     * @return string
     */
    public function acronym($text): string
    {
        $arr = explode(' ', $text);

        if (count($arr) === 1) {
            return strtoupper(substr($arr[0], 0, 2));
        }

        return strtoupper(substr($arr[0], 0, 1).substr($arr[1], 0, 1));
    }
}
