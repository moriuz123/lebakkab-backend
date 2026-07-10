<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'icon' => $this->icon,
            'menu_type' => $this->menu_type,
            'link_type' => $this->link_type,
            'url' => $this->url, // Akan memanggil getUrlAttribute() otomatis
            'sort_order' => $this->sort_order,
            'parent_id' => $this->parent_id,
            'children' => MenuApiResource::collection($this->whenLoaded('children')),
        ];
    }
}
