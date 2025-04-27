<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $operations = view('admin.orders.sub.operations', ['instance' => $this])->render();
        $status = view('admin.orders.sub.status', ['instance' => $this])->render();

        return [
            'id'            => $this->id,
            'user'          => $this->user->full_name,
            'status'        => $status,
            'total'         => $this->total,
            'operations'    => $operations,
        ];
    }
}