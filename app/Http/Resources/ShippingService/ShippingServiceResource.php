<?php

namespace App\Http\Resources\ShippingService;

use Illuminate\Http\Resources\Json\JsonResource;

class ShippingServiceResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'contact' => $this->contact,
            'phone' => $this->phone,
            'image' => $this->image,
            'credentials_template' => json_decode($this->credentials),
            'created_at' => $this->created_at->format('M d, Y h:i A'),
        ];
    }
}
