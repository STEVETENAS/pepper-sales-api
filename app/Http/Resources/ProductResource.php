<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this['id'],
            'title' => $this['title'],
            'price' => $this['price'],
            'weight' => $this['weight'],
            'image' => $this->getFirstMediaUrl('Product-images'),
            'description' => $this['description'],
            'created_at' => $this['created_at'],
            'updated_at' => $this['updated_at'],
        ];
    }
}
