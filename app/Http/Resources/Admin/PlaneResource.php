<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $operations = view('admin.plans.sub.operations', ['instance' => $this])->render();
        $status = view('admin.plans.sub.status', ['instance' => $this])->render();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'price' => $this->price,
            'status' => $status,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'operations'                => $operations,
        ];
    }
}
