<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Commentary;
use Illuminate\Support\Facades\Validator;

class CommentaryController extends Controller
{
  
    public function index()
    {
        //Se traen todos los comentarios de la base de datos
        $comentarios = Commentary::all();

        //Se verifica en caso este vacia
        if($comentarios == NULL){
            return "No existen comentarios";
        }
        return response()->json($comentarios);
    }


    public function store(Request $request, $id_video, $id_usuario)
    {
        $comentario = new Commentary();

        $validarDatos = Validator::make($request->all(),[
            'contenido' => 'required|max:500',
        ],[
            'contenido.required' => 'Debe ingresar contenido',
            'contenido.max:500' => 'El contenido no debe exceder los 500 caracteres',
        ]);

        if ($validarDatos->fails()){
            return back()->with('comentarioError', $validarDatos->errors());
        }

        $comentario->contenido = $request->contenido;
        $comentario->id_usuario = $request->id_usuario;
        $comentario->id_video = $request->id_video;
        $comentario->save();

        return back()->with('comentarioRealizado', 'Comentario realizado');
    }

    public static function show($id)
    {
        $comentario = Commentary::find($id);
        return $comentario;
    }

    public function storeComment(Request $request){
        $comentario = new Commentary();

        $validarDatos = Validator::make($request->all(),[
            'contenido' => 'required|max:500',
        ],[
            'contenido.required' => 'Debe ingresar contenido',
            'contenido.max:500' => 'El contenido no debe exceder los 500 caracteres',
        ]);

        if ($validarDatos->fails()){
            return back()->with('register', $validarDatos->errors());
        }

        $comentario->contenido = $request->contenido;
        $comentario->id_usuario = $request->id_usuario;
        $comentario->id_video = $request->id_video;
        $comentario->save();

        return back()->with('register', 'Comentario registrado !');
    }

    
    
    public function update(Request $request, $id)
    {
        $comentario = Commentary::findOrFail($id);
        
        $validarDatos = Validator::make($request->all(),[
            'contenido' => 'required|max:500',
            'id_usuario' => 'required',
            'id_video' => 'required'
        ],[
            'contenido.required' => 'Debe ingresar contenido',
            'contenido.max:500' => 'El contenido no debe exceder los 500 caracteres',
            'id_usuario.required' => 'Debe ingresar el id del usuario',
            'id_video.required' => 'Debe ingresar el id del video'
        ]);

        if ($validarDatos->fails()){
            return back()->with('register',$validarDatos->errors());
        }

        $comentario->contenido = $request->contenido;
        $comentario->id_usuario = $request->id_usuario;
        $comentario->id_video = $request->id_video;

        $comentario->save();

        return redirect()->route('vistaCrudAdmin')->with('register','Comentarios actualizados!');
    }


    public function destroy($id)
    {
        $comentario = Commentary::findOrFail($id);
        
        $comentario->delete();

        return back()->with('register','Comentario eliminado !');
    }
}
