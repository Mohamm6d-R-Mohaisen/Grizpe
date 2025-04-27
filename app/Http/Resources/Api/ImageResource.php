<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    { 
        return [ 
            'id' => $this->id,
            'path' => getImageUrl($this->path, 'medium'),
            'url' => getImageUrl($this->path, 'medium'),
            'original_image_url' => getImageUrl($this->path, 'original'),
            'small_image_url' => getImageUrl($this->path, 'thumbnail'),
            'medium_image_url' => getImageUrl($this->path, 'medium'),
            'large_image_url' => getImageUrl($this->path, 'large'),
        ];
    }
}