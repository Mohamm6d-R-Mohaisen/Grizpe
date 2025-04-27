<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $operations = view('admin.blogs.sub.operations', ['instance' => $this])->render();
        $status = view('admin.blogs.sub.status', ['instance' => $this])->render();
        return [
            'id'                        =>$this->id,
            'title'                     =>$this->title,
            'image'                     =>$this->image ? '<img src="' . asset($this->image) . '" alt="Image" width="50" height="50">' : null,
            'status'                    =>$status,
            'created_at'                => $this->created_at->format('H:i:s Y-m-d'),
            'operations'                => $operations,

        ];    }
}
