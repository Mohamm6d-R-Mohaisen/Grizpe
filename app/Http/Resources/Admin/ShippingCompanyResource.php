<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ShippingCompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $operations = view('admin.shipping_companies.sub.operations', ['instance' => $this])->render();
        $status = view('admin.shipping_companies.sub.status', ['instance' => $this])->render();

        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'cost'          => $this->cost,
            'tracking_url'  => $this->tracking_url,
            'status'        => $status,
            'operations'    => $operations,
        ];
    }
}