<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
            return "No hay usuarios registrados";
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

        $request->validate(
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

        $user->username= $request->username;
        $user->password= $request->password;
        $user->fecha_nacimineto= $request->fecha_nacimineto;
        $user->monedero= $request->monedero;
        $user->email= $request->email;
        $user->id_comuna= $request->id_comuna;
        $user->id_tipo_usuario= $request->id_tipo_usuario;

        $user->save();

        return response()->json([
            "mesagge"=> "Se ha creado un nuevo usuario ",
            $user
        ]);


        
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
            return "No existe un usuario registrado con la id ingresada";
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
            return "No existe un usuario registrado con la id ingresada";
        }

        $request->validate(
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

        $user->username= $request->username;
        $user->password= $request->password;
        $user->fecha_nacimineto= $request->fecha_nacimineto;
        $user->monedero= $request->monedero;
        $user->email= $request->email;
        $user->id_comuna= $request->id_comuna;
        $user->id_tipo_usuario= $request->id_tipo_usuario;

        $user->save();

        return response()->json([
            "mesagge"=> "Se ha editado un usuario ",
            $user
        ]);
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
            return "No existe un usuario registrado con la id ingresada";
        }

        $user->delete();
        return response()->json([
            "mesagge"=> "Se ha eliminado un usuario ",
            $user
        ]);

    }
}
