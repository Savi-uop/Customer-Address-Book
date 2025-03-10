<?php

namespace App\Http\Resources;
// namespace App\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Customer;      
use Illuminate\Http\Request; 

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'addresses' => $this->addresses, // Include addresses if needed
        ];
    }
}
