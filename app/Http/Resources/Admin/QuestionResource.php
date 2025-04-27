<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $operations = view('admin.question.sub.operations', ['instance' => $this])->render();
        $status = view('admin.question.sub.status', ['instance' => $this])->render();
        return [
            'id'                        =>$this->id,
            'title'                      =>$this->title,
            'description'                  =>$this->description,
            'status'                    =>$status,
            'created_at'                => $this->created_at->format('H:i:s Y-m-d'),
            'operations'                => $operations,

        ];
    }
}
