<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::all();
        if ($user==NULL) {
            return response()->json(["message"=> "No exiten usuarios"],404);
        }

        return response()->json($user);
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
        $user = new User();
        /*
        if(User::find($request->username)){
            return response()->json([
                "message" => ""
            ], 400);
        }
        */
        $validarDatos = Validator::make($request->all(),
            [
                'username'=>'required|max:16|unique:posts',
                'password'=>'required|max:30',
                'fecha_nacimineto'=>'required',
                'monedero'=>'required',
                'email'=>'required|max:30',
                'id_comuna'=>'required',
                'id_tipo_usuario'=>'required'
            ],
            [
                'username'.'unique:posts'=> 'El nombre de usuario ya existe',
                'username.required'=>'Debe ingresar un nombre de usuario',
                'password.required'=>'Debe ingresar una contraseña',
                'fecha_nacimineto.required'=>'Debe ingresar una fecha de nacimiento',
                'monedero.required'=>'Debe ingresar una cantidad de dinero',
                'email.required'=>'Debe ingresar un correo electronico',
                'id_comuna.required'=>'Debe ingresar un id de comuna',
                'id_tipo_usuario.required'=>'Debe ingresar un id de tipo de usuario'
            ]
        );

        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }

        $user->username= $request->username;
        $user->password= $request->password;
        $user->fecha_nacimineto= $request->fecha_nacimineto;
        $user->monedero= $request->monedero;
        $user->email= $request->email;
        $user->id_comuna= $request->id_comuna;
        $user->id_tipo_usuario= $request->id_tipo_usuario;

        $user->save();

        return response()->json([
            "message"=> "Se ha creado un nuevo usuario ",
            $user
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
        //
        $user=User::find($id);
        if ($user==NULL) {
            return response()->json(["message"=> "No exiten usuarios asociadas a la id ingresada"],404);
        }

        return response()->json($user);


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
        $user=User::find($id);
        if ($user==NULL) {
            return response()->json(["message"=> "No exiten usuarios asociadas a la id ingresada"],404);
        }

        $validarDatos = Validator::make($request->all(),
            [
                'username'=>'required|max:16',
                'password'=>'required|max:30',
                'fecha_nacimineto'=>'required',
                'monedero'=>'required',
                'email'=>'required|max:60',
                'id_comuna'=>'required',
                'id_tipo_usuario'=>'required'
            ],
            [
                'username.required'=>'Debe ingresar un nombre de usuario',
                'password.required'=>'Debe ingresar una contraseña',
                'fecha_nacimineto.required'=>'Debe ingresar una fecha de nacimiento',
                'monedero.required'=>'Debe ingresar una cantidad de dinero',
                'email.required'=>'Debe ingresar un correo electronico',
                'id_comuna.required'=>'Debe ingresar un id de comuna',
                'id_tipo_usuario.required'=>'Debe ingresar un id de tipo de usuario'
            ]
        );

        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }

        $user->username= $request->username;
        $user->password= $request->password;
        $user->fecha_nacimineto= $request->fecha_nacimineto;
        $user->monedero= $request->monedero;
        $user->email= $request->email;
        $user->id_comuna= $request->id_comuna;
        $user->id_tipo_usuario= $request->id_tipo_usuario;

        $user->save();

        return response()->json([
            "message"=> "Se ha editado un usuario ",
            $user
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
        $user=User::find($id);
        if ($user==NULL) {
            return response()->json(["message"=> "No exiten usuarios asociadas a la id ingresada"],404);
        }

        $user->delete();
        return response()->json([
            "message"=> "Se ha eliminado un usuario ",
            $user
        ],202);

    }
}
