<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class LoginController extends Controller
{
    
    //Funcion de login
    public function login(){
        //Se consiguen los datos ingresados por el usuario en el formulario de login
        $credenciales = request()->only('username', 'password');

        //Se verifica el login
        if(Auth::attempt($credenciales)){
            request()->session()->regenerate();

            return redirect()->route('vistaIndice')->with('loginCorrecto','Logueo correcto !');
        }
        //Si el logueo no fue correcto
        return back()->with('loginError','Credenciales incorrectas, Verifique sus datos e intentelo de nuevo');

    }

    //Funcion para desconectar al usuario
    public function logout(Request $request){
        //Se desconecta al usuario
        Auth::logout();
        
        //Se invalida la sesion
        $request->session()->invalidate();

        //Se redirecciona al indice
        return redirect()->route('vistaIndice')->with('logout','Te has desconectado');
    }

}
