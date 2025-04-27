<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $operations = view('admin.products.sub.operations', ['instance' => $this])->render();
        $status = view('admin.products.sub.status', ['instance' => $this])->render();

        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'categories'        => $this->categories->pluck('name'),
            // 'price'             => $this->price,
            'status'            => $status,
            'created_at'        => $this->created_at->format('H:i:s Y-m-d'),
            'operations'        => $operations,
        ];
    }
}