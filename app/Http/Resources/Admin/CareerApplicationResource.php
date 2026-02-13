<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CareerApplicationResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'dob' => $this->dob,
            'phone' => $this->phone,
            'cv_path' => $this->cv_path,
            'cv_url' => asset('storage/' . $this->cv_path),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
