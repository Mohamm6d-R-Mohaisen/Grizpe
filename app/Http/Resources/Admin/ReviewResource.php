<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $operations = view('admin.reviews.sub.operations', ['instance' => $this])->render();
        $status = view('admin.reviews.sub.status', ['instance' => $this])->render();

        return [
            'id'            => $this->id,
            'name'          =>$this->name,
            'status'        => $status,
            'image'                     =>$this->image ? '<img src="' . asset($this->image) . '" alt="Image" width="50" height="50">' : null,
            'rating'        => $this->rating,
            'comment'       => $this->comment,
            'operations'    => $operations,
        ];
    }
}
