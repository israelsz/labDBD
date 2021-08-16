<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
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
        $user = new User();
    
        $validarDatos = Validator::make($request->all(),
            [
                'username'=>'required|max:16|unique:users,username',
                'password'=>'required|max:30',
                'fecha_nacimiento'=>'required',
                'email'=>'required|max:30|unique:users,email',
                'id_comuna'=>'required',
            ],
            [
                'username.unique'=>'El nombre de usuario ya existe',
                'username.required'=>'Debe ingresar un nombre de usuario',
                'password.required'=>'Debe ingresar una contraseña',
                'fecha_nacimiento.required'=>'Debe ingresar una fecha de nacimiento',
                'email.required'=>'Debe ingresar un correo electronico',
                'email.unique'=>'El correo electronico ya existe',
                'id_comuna.required'=>'Debe ingresar un id de comuna'
            ]
        );

        if ($validarDatos->fails()){
        //Si el logueo no fue correcto
            return back()->with('registerError', $validarDatos->errors());
        }

        $user->username= $request->username;
        $user->password= Hash::make($request->password); //Se encripta la contraseña
        $user->fecha_nacimiento= $request->fecha_nacimiento;
        $user->monedero= 0.0;
        $user->email= $request->email;
        $user->id_comuna= $request->id_comuna;
        $user->id_tipo_usuario= 1;

        $user->save();

        return redirect()->route('vistaIndice')->with('register','Te has registrado con exito !');

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
                'fecha_nacimiento'=>'required',
                'monedero'=>'required',
                'email'=>'required|max:60',
                'id_comuna'=>'required',
                'id_tipo_usuario'=>'required'
            ],
            [
                'username.required'=>'Debe ingresar un nombre de usuario',
                'password.required'=>'Debe ingresar una contraseña',
                'fecha_nacimiento.required'=>'Debe ingresar una fecha de nacimiento',
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
        $user->fecha_nacimiento= $request->fecha_nacimiento;
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
