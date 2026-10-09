<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'full_name' => $this->full_name,
            'professional_title' => $this->professional_title,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'bio' => $this->when($request->user()?->tokenCan('reports:read'), $this->bio),
            'skills' => $this->when($request->user()?->tokenCan('reports:read'), $this->skills),
            'project_url' => $this->project_url,
            'github_url' => $this->github_url,
            'linkedin_url' => $this->linkedin_url,
            'course' => $this->whenLoaded('course', fn () => [
                'id' => $this->course->id,
                'name' => $this->course->name,
            ]),
            'owner_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
