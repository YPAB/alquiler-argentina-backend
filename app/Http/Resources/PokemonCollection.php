<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PokemonCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // final array to be return.
        $pokemons = [];
        foreach($this->collection as $pokemon) {
            
            $types = [];

             foreach($pokemon->types as $type) {
                array_push($types, [
                    'type'            => $type->type_name,

                ]);
             }

             array_push($pokemons, [
                 'id'               => $pokemon->pok_id,
                 'name'             => $pokemon->pok_name,
                 'height'           => $pokemon->pok_height,
                 'weight'           => $pokemon->pok_weight,
                 'base_experience'  => $pokemon->pok_base_experience,
                 'types'            => $types,

             ]);
             

        }

        return [
            'current_page' => $this->currentPage(),
            'pokemons' => $pokemons,

            'first_page_url' => $this->url(1),
            'from' => $this->firstItem(),
            'last_page' => $this->lastPage(),
            'last_page_url' => $this->url($this->lastPage()),
            'next_page_url' => $this->nextPageUrl(),
            'path' => $this->path(),
            'per_page' => $this->perPage(),
            'prev_page_url' => $this->previousPageUrl(),
            'to' => $this->lastItem(),
            'total' => $this->total(),
        ];
    }
}
