<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
    //    $this->language->content = substr($this->language->content, 0, 150).'...';
        return [
            'id' => $this->id,
            'public' => $this->public,
            'language' => $this->language,
            'created_at' => $this->created_at->format('d.m.Y'),
        ];
    }
}
