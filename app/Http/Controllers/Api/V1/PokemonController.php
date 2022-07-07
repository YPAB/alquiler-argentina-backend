<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use App\Http\Resources\PokemonCollection;

class PokemonController extends ApiController
{
    /**
    * @OA\Get(
    *     path="/api/v1/pokemon",
    *     tags={"Pokemon"},
    *     summary="Listado de pokemos y sus tipos asociados.",
    *     description="Permite detallar los pokemos y sus tipos registrados.",  
    *     @OA\Response(
    *         response=200,
    *         description="Operacion Exitosa."
    *     ),

     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          description="Nombre del Pokemon a buscar",
     *          @OA\Schema(
     *          type="string"
     *          )
     *      ),           
    
     *      
    * )
    */

    public function index(Request $request)
    {
        $search = $request->input('name');
        $pokemons = new PokemonCollection (Pokemon::with('types')->where('pok_name','like','%'.$search.'%')
                            ->orderBy('pok_id')
                            ->paginate(5));
        return $this->success('OK',$pokemons);
    }


    /**
    * @OA\Get(
    *     path="/api/v1/pokemons",
    *     tags={"byPokemons"},
    *     summary="Filtros por tipos..",
    *     description="Permite detallar los pokemos y el tipo buscado.",  
    *     @OA\Response(
    *         response=200,
    *         description="Operacion Exitosa."
    *     ),

     *      @OA\Parameter(
     *          name="type",
     *          in="query",
     *          required=true,
     *          description="Ingrese Tipo de Pokemon",
     *          @OA\Schema(
     *          type="string"
     *          )
     *      ),
     *             
     *      
    * )
    */

    public function pokemons(Request $request)
    {
        $search = $request->input('type');
        $typeName = $search = is_array($search) ? $search : [$search];
        $pokemons = new PokemonCollection (Pokemon::whereHas('types', function($q) use($typeName) {
            $q->whereIn('type_name', $typeName);
        })->paginate(10));
        
        return $this->success('OK',$pokemons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Http\Response
     */
    public function show(Pokemon $pokemon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pokemon $pokemon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pokemon $pokemon)
    {
        //
    }
}
