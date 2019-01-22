<?php

namespace App\Http\Resources\Movies;

use Illuminate\Http\Resources\Json\Resource;

class MovieCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'star actor' => $this->lead_actor,
            'description' => $this->description,
            'href' => [
                'more info' => route('movies.show',$this->id)
            ]
        ];
    }
}
