<?php

namespace App\Http\Resources;

use App\Models\News;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
        'news_id' => $this->id,
        'news_headlline' => $this->newsHead,
        'news_body' => $this->newsBody,
        'store_location' => $this->storeName,
        ];
        }
        public function with($request){
        return [
        'version' => "1.0.0",
        ];
    }
}
