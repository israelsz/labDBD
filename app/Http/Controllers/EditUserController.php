<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Commune;
use App\Models\User;

class EditUserController extends Controller
{
    public function getCommune($id_comuna){
        $comuna=Commune::find($id_comuna);
        
        return $comuna;
        
    }

    public function getUser($id_user){
        $usuario=User::find($id_user);

        return $usuario;
    }

    public function update(Request $request, $usuario)
    {
        $user=User::findOrFail($usuario);
        $validarDatos = Validator::make($request->all(),
            [
                'username'=>'max:16|unique:users,username',
                'password'=>'max:30',
                'email'=>'max:30|unique:users,email',
            ],
            [
                'username.unique'=>'El nombre de usuario ya existe',
                'email.unique'=>'El correo electronico ya existe'
            ]
        );

        if ($validarDatos->fails()){
            return back()->with('editUserError', $validarDatos->errors());
        }

        if ($request->username!=null) {
            $user->username= $request->username;
        }

        if ($request->password!=null){
            $user->password= $request->password;
        }
        if ($request->password!=null){
            $user->email= $request->email;
        }
        if ($request->id_comuna!=null) {
            $user->id_comuna= $request->id_comuna;
        }
    
        $user->save();

        return redirect('/');
    }
}
