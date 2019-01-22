<?php

namespace App\Http\Resources\Movies;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'name' => $this->name,
            'star_actor' => $this->lead_actor,
            'description' => $this->description,
            'rating' => $this->reviews->count() > 0 ? 
                round($this->reviews->sum('stars')/$this->reviews->count(),2) : 'no reviews',
            'genre' => $this->genre,
            'href' => [
                'reviews' => route('review.index',$this->id)
            ]
        ];
    }
}
