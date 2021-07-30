<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserType;
use Illuminate\Support\Facades\Validator;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoUsuario= UserType::all();
        
        if ($tipoUsuario==NULL) {
            return response()->json(["message"=> "No exiten tipos de usuarios"],404);
        }

        return response()->json($tipoUsuario);
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
        $tipoUsuario = new UserType();

        $validarDatos = Validator::make($request->all(),
            [
                'nombre_tipo_usuario'=>'required|max:60',
                'descripcion_tipo_usuario'=>'required|max:500'
            ],
            [
                'nombre_tipo_usuario.requider'=>'Debe ingresar un nombre al tipo de usuario',
                'descripcion_tipo_usuario.required'=> 'Debe ingresar una descripcion del tipo de usuario'
            ]
            );
        
        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }

        $tipoUsuario->nombre_tipo_usuario=$request->nombre_tipo_usuario;
        $tipoUsuario->descripcion_tipo_usuario=$request->descripcion_tipo_usuario;

        $tipoUsuario->save();

        return response()->json([
            "message"=> "Se ha creado un nuevo tipo de usuario",
            $tipoUsuario
        ],202);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoUsuario=UserType::find($id);

        if ($tipoUsuario==NULL) {
            return response()->json(["message"=> "No exiten tipos de usuarios asociadas a la id ingresada"],404);
        }

        return response()->json($tipoUsuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipoUsuario=UserType::find($id);

        if ($tipoUsuario==NULL) {
            return response()->json(["message"=> "No exiten tipos de usuarios asociadas a la id ingresada"],404);
        }

        $validarDatos = Validator::make($request->all(),
            [
                'nombre_tipo_usuario'=>'required|max:60',
                'descripcion_tipo_usuario'=>'required|max:100'
            ],
            [
                'nombre_tipo_usuario.requider'=>'Debe ingresar un nombre al tipo de usuario',
                'descripcion_tipo_usuario.required'=> 'Debe ingresar una descripcion del tipo de usuario'
            ]
        );
        
        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }

        $tipoUsuario->nombre_tipo_usuario=$request->nombre_tipo_usuario;
        $tipoUsuario->descripcion_tipo_usuario=$request->descripcion_tipo_usuario;

        $tipoUsuario->save();

        return response()->json([
            "message"=> "Se ha actualizado el tipo de usuario",
            $tipoUsuario
        ],202);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoUsuario=UserType::find($id);

        if ($tipoUsuario==NULL) {
            return response()->json(["message"=> "No exiten tipos de usuarios asociadas a la id ingresada"],404);
        }

        $tipoUsuario->delete();

        return response()->json(
            [
                "message"=>"Se ha borrado el tipo de usuario",
                "id"=>$tipoUsuario->id
            ]
            ,202);
    }
}
