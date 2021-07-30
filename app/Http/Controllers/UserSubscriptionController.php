<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Validator;

class UserSubscriptionController extends Controller
{
    public function index()
    {
        //Se traen todos las suscripciones de usuario de la base de datos
        $usuarioSuscripcion = UserSubscription::all();

        //Se verifica en caso este vacia
        if($usuarioSuscripcion == NULL){
            return "No existen usuario suscripcion ";
        }
        return response()->json($usuarioSuscripcion);
    }

    public function store(Request $request)
    {
        $usuarioSuscripcion = new UserSubscription();
        $validarDatos = Validator::make($request->all(),[
            'id_usuario_suscripcion' => 'required',
            'id_usuario_suscriptor' => 'required'
        ],[
            'id_usuario_suscripcion.required' => 'Debe ingresar el id del usuario suscripcion',
            'id_usuario_suscriptor.required' => 'Debe ingresar el id del usuario suscriptor'
        ]);

        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }

        $usuarioSuscripcion->id_usuario_suscriptor= $request->id_usuario_suscriptor;
        $usuarioSuscripcion->id_usuario_suscripcion= $request->id_usuario_suscripcion;
        $usuarioSuscripcion->save();
        return response()->json([
            "message" => "Se ha creado un nueva suscripcion",
            $usuarioSuscripcion
        ]);
    }

    public function show($id)
    {
        $usuarioSuscripcion = UserSubscription::find($id);
        
        if($usuarioSuscripcion == NULL){
            return "No existe un usuario suscripcion";
        }

        return response()->json($usuarioSuscripcion);
    }

    public function update(Request $request, $id)
    {
        $usuarioSuscripcion = UserSubscription::find($id);
        if($usuarioSuscripcion == NULL){
            return "No existe un usuario suscripcion";
        }
        $validarDatos = Validator::make($request->all(),[
            'id_usuario_suscripcion' => 'required',
            'id_usuario_suscriptor' => 'required'
        ],[
            'id_usuario_suscripcion.required' => 'Debe ingresar el id del usuario suscripcion',
            'id_usuario_suscriptor.required' => 'Debe ingresar el id del usuario suscriptor'
        ]);

        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }

        $usuarioSuscripcion->id_usuario_suscriptor= $request->id_usuario_suscriptor;
        $usuarioSuscripcion->id_usuario_suscripcion= $request->id_usuario_suscripcion;
        $usuarioSuscripcion->save();
        return response()->json([
            "message" => "Se ha actualizado un nueva suscripcion",
            $usuarioSuscripcion
        ]);
    }
    public function destroy($id)
    {
        $usuarioSuscripcion = UserSubscription::find($id);
        
        if($usuarioSuscripcion == NULL){
            return "No existe un usuario suscripcion asociado a ese id";
        }

        $usuarioSuscripcion->delete();
        return response()->json([
            "message" => "Se ha borrado el usuario suscripcion",
            "id" => $usuarioSuscripcion->id
        ]);
    }
}
