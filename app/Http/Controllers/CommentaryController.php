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


    public function store(Request $request)
    {
        $comentario = new Commentary();

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
            return response()->json($validarDatos->errors(), 400);
        }

        $comentario->contenido = $request->contenido;
        $comentario->id_usuario = $request->id_usuario;
        $comentario->id_video = $request->id_video;
        $comentario->save();

        return response()->json([
            "message" => "Se ha creado un nuevo comentario",
            $comentario
        ]);
    }

    public function show($id)
    {
        $comentario = Commentary::find($id);
        
        if($comentario == NULL){
            return "No existe un comentario asociado a ese id";
        }

        return response()->json($comentario);
    }


    
    public function update(Request $request, $id)
    {
        $comentario = Commentary::find($id);
        if($comentario == NULL){
            return "No existe un comentario asociada a ese id";
        }
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
            return response()->json($validarDatos->errors(), 400);
        }

        $comentario->contenido = $request->contenido;
        $comentario->id_usuario = $request->id_usuario;
        $comentario->id_video = $request->id_video;

        $comentario->save();
        return response()->json($comentario);
    }


    public function destroy($id)
    {
        $comentario = Commentary::find($id);
        
        if($comentario == NULL){
            return "No existe un comentario asociado a ese id";
        }

        $comentario->delete();
        return response()->json([
            "message" => "Se ha borrado el comentario",
            "id" => $comentario->id
        ]);
    }
}
