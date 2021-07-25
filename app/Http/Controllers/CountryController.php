<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    
    //Muestra todos los paises
    public function index()
    {
        //Se traen todos los paises de la tabla countries de la base de datos
        $countries = Country::all();

        //Se verifica en caso este vacia
        if($countries == NULL){
            return "No existen paises.";
        }
        //Se retornan los paises en formato json
        return response()->json($countries);
    }

    //Guarda un nuevo pais -> Create
    public function store(Request $request)
    {
        $country = new Country();

        $request->validate([
            'nombre_pais' => 'required|max:100',
        ]);

        $country->nombre_pais = $request->nombre_pais;
        $country->save();

        return response()->json([
            "message" => "Se ha creado un nuevo país",
            "id" => $country->id
        ]);
    }

    //Muestra solo un pais, según su id -> Read
    public function show($id)
    {
        $country = Country::find($id);
        
        if($country == NULL){
            return "No existe un pais asociado a ese id";
        }

        return response()->json($country);
    }

    //Actualiza un pais -> Update
    public function update(Request $request, $id)
    {
        $country = Country::find($id);
        
        if($country == NULL){
            return "No existe un pais asociado a ese id";
        }
        //Se verifica no se intenta ingresar un nombre vacio
        if($request->nombre_pais != NULL){
            $country->nombre_pais = $request->nombre_pais;
        }
        $country->save();
        return response()->json($country);
    }

    //Borra un pais -> Delete
    public function destroy($id)
    {
        $country = Country::find($id);
        
        if($country == NULL){
            return "No existe un pais asociado a ese id";
        }

        $country->delete();
        return response()->json([
            "message" => "Se ha borrado el pais",
            "id" => $country->id
        ]);
    }
}
