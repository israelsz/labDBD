<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    
    //Muestra todas las regiones
    public function index()
    {
        //Se traen todas las regiones de la tabla regions de la base de datos
        $regions = Region::all();

        //Se verifica en caso este vacia
        if($regions == NULL){
            return "No existen regiones.";
        }
        //Se retornan los paises en formato json
        return response()->json($regions);
    }

    //Guarda una nueva region-> Create
    public function store(Request $request)
    {
        $region = new Region();

        $request->validate([
            'nombre_region' => 'required|max:100',
            'id_pais' => 'required'
        ]);

        $region->nombre_region = $request->nombre_region;
        $region->save();

        return response()->json([
            "message" => "Se ha creado una nueva region",
            "id" => $region->id
        ]);
    }

    //Muestra solo una region, según su id -> Read
    public function show($id)
    {
        $region = Region::find($id);
        
        if($region == NULL){
            return "No existe una region asociada a ese id";
        }

        return response()->json($region);
    }

    //Actualiza una region -> Update
    public function update(Request $request, $id)
    {
        $region = Region::find($id);
        
        if($region == NULL){
            return "No existe una region asociada a ese id";
        }
        //Se verifica no se intenta ingresar un nombre vacio
        if($request->nombre_region != NULL){
            $region->nombre_region = $request->nombre_region;
        }
        $region->save();
        return response()->json($region);
    }

    //Borra una region -> Delete
    public function destroy($id)
    {
        $region = Region::find($id);
        
        if($region == NULL){
            return "No existe una region asociada a ese id";
        }

        $region->delete();
        return response()->json([
            "message" => "Se ha borrado la region",
            "id" => $region->id
        ]);
    }
}
