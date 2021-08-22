<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommuneController extends Controller
{
    public static function index()
    {
        //Se traen todas las comunas de la tabla de la base de datos
        $communes = Commune::all();

        //Se verifica en caso este vacia
        if($communes == NULL){
            return "No existen comunas.";
        }
        return $communes;
    }

    public function store(Request $request)
    {
        $commune = new Commune();

        $validarDatos = Validator::make($request->all(),[
            'nombre_comuna' => 'required|max:60',
            'id_region' => 'required'
        ],[
            'nombre_comuna.required' => 'Debe de ingresar un nombre de comuna',
            'nombre_comuna.max:60' => 'El nombre de la comuna no puede exceder 60 caracteres ',
            'id_region.required' => 'Debe de ingresar el id de la region a la que pertenece la comuna'
        ]);

        if ($validarDatos->fails()){
            return back()->with('register',$validarDatos->errors());
        }

        $commune->nombre_comuna = $request->nombre_comuna;
        $commune->id_region = $request->id_region;
        $commune->save();

        return back()->with('register','Comuna creada !');
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
        $commune = Commune::findOrFail($id);
        
        $validarDatos = Validator::make($request->all(),[
            'nombre_comuna' => 'required|max:60',
            'id_region' => 'required'
        ],[
            'nombre_comuna.required' => 'Debe de ingresar un nombre de comuna',
            'nombre_comuna.max:60' => 'El nombre de la comuna no puede exceder 60 caracteres ',
            'id_region.required' => 'Debe de ingresar el id de la region a la que pertenece la comuna'
        ]);

        if ($validarDatos->fails()){
            return back()->with('register',$validarDatos->errors());
        }
        
        $commune->nombre_comuna = $request->nombre_comuna;
        $commune->id_region = $request->id_region;
        $commune->save();

        return redirect()->route('vistaCrudAdmin')->with('register','Comuna actualizada!');
    }

    public function destroy($id)
    {
        $commune = Commune::findOrFail($id);
    
        $commune->delete();

        return back()->with('register','Comuna eliminada');
    }
}