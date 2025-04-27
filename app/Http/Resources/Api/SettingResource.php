<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    { 
        return [ 
            'email'     => $this->valueOf('email'),
            'phone'     => $this->valueOf('phone'),
            'whatsapp'  => $this->valueOf('whatsapp'),
            'linkedin'  => $this->valueOf('linkedin'),
            'facebook'  => $this->valueOf('facebook'),
            'instagram' => $this->valueOf('instagram'),
            'twitter'   => $this->valueOf('twitter'),
            'address'   => $this->valueOf('address'),
        ];
    }
}
