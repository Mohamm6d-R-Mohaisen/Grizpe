<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $gaurd = Auth::getDefaultDriver();

        return [
            'id'                    => $this->id,
            'name'                  => $this->full_name,
            'phone_code'            => $this->phone_code,
            'phone'                 => $this->phone,
            'email'                 => $this->email,
            'image'                 => env('APP_URL') . $this->image,
        ];
    }
}
