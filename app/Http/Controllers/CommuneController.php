<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use Illuminate\Http\Request;

class CommuneController extends Controller
{
    public function index()
    {
        //Se traen todas las comunas de la tabla de la base de datos
        $communes = Commune::all();

        //Se verifica en caso este vacia
        if($communes == NULL){
            return "No existen comunas.";
        }
        return response()->json($communes);
    }

    public function store(Request $request)
    {
        $commune = new Commune();

        $request->validate([
            'nombre_comuna' => 'required|max:60',
            'id_region' => 'required'
        ]);

        $commune->nombre_comuna = $request->nombre_comuna;
        $commune->save();

        return response()->json([
            "message" => "Se ha creado una nueva comuna",
            "id" => $commune->id
        ]);
    }

    public function show($id)
    {
        $commune = Commune::find($id);
        
        if($commune == NULL){
            return "No existe una comuna asociada a ese id";
        }

        return response()->json($commune);
    }

    public function update(Request $request, $id)
    {
        $commune = Commune::find($id);
        
        if($commune == NULL){
            return "No existe una comuna asociada a ese id";
        }
        //Se verifica no se intenta ingresar un nombre vacio
        if($request->nombre_comuna != NULL){
            $commune->nombre_comuna = $request->nombre_comuna;
        }
        $commune->save();
        return response()->json($commune);
    }

    public function destroy($id)
    {
        $commune = Commune::find($id);
        
        if($commune == NULL){
            return "No existe una comuna asociada a ese id";
        }

        $commune->delete();
        return response()->json([
            "message" => "Se ha borrado la comuna",
            "id" => $commune->id
        ]);
    }
}
