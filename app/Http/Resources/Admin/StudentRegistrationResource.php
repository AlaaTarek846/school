<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentRegistrationResource extends JsonResource
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
            'country' => $this->country,
            'file_path' => $this->file_path,
            'file_url' => asset('storage/' . $this->file_path),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
