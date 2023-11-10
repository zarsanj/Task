<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            User::NAME => $this->name,
            User::EMAIL => $this->email,
            User::MOBILE => $this->mobile,
            User::CREATED_AT => $this->created_at,
        ];
    }
}
