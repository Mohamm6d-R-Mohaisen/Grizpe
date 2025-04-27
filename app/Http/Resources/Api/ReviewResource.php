<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    { 
        return [ 
            // 'id'                => $this->id,
            'total'             => 0,
            'total_rating'      => $this->totalRatings(),
            'average_rating'    => $this->product->averageRating(),
            'percentage'        => [],
            'reviews'           => [],
        ];
    }
}