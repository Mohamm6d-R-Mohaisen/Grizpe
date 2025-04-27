<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $operations = view('admin.attribute_values.sub.operations', ['instance' => $this])->render();
        $status = view('admin.attribute_values.sub.status', ['instance' => $this])->render();

        return [
            'id'            => $this->id,
            'attribute'     => $this->attribute->name,
            'name'          => $this->name,
            'status'        => $status,
            'created_at'    => $this->created_at->format('H:i:s Y-m-d'),
            'operations'    => $operations,
        ];
    }
}