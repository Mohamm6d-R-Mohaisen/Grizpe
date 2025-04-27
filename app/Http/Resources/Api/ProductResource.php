<?php

namespace App\Http\Resources\Api;

use App\Models\Product;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'sku'           => $this->sku,
            'type'          => $this->categories->first()->name,
            'name'          => $this->name,
            'url_key'       => $this->slug,
            'color'         => '',
            'quantity'      => $this->inventory->quantity ?? 0,
            'price'         => $this->price,
            'offer_price'   => $this->offer_price,
            'formated_price' => $this->formatted_price,
            'formated_offer_price' => $this->formated_offer_price,
            'short_description' => $this->short_description,
            'description' => $this->long_description,
            'images' => ImageResource::collection($this->images),
            // 'videos' => VideoResource::collection($this->videos),
            'base_image' => ImageResource::collection($this->images),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'reviews' => ReviewResource::make($this->reviews),
            'in_stock' => $this->inventory->hasEnoughStock(1),
            'is_saved' => '',
            'is_wishlisted' => auth()->check() ? auth()->user()->isFavorite($this->id) : false,
            'is_item_in_cart' => '',
            'show_quantity_changer' => true,
        ];
    }
}