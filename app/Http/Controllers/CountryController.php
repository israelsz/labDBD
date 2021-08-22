<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $validarDatos = Validator::make($request->all(),[
            'nombre_pais' => 'required|max:100'
        ],[
            'nombre_pais.required' => 'Debe de ingresar el nombre del pais',
            'nombre_pais.max:100' => 'El nombre no puede exceder los 100 caracteres'
        ]);

        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }
        

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

        $validarDatos = Validator::make($request->all(),[
            'nombre_pais' => 'required|max:100'
        ],[
            'nombre_pais.required' => 'Debe de ingresar el nombre del pais',
            'nombre_pais.max:100' => 'El nombre no puede exceder los 100 caracteres'
        ]);

        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }

        $country->nombre_pais = $request->nombre_pais;
        $country->save();
        
        return response()->json($country);
    }

    //Borra un pais -> Delete
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
 
        $country->delete();

        return back()->with('register','Pais eliminado !');
    }
}
