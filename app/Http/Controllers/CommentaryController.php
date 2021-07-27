<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Commentary;

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
        $request->validate([
            'contenido' => 'required|max:200',
            'id_usuario' => 'required',
            'id_video' => 'required',
        ],[ //Mensajes de error abajo
            'contenido.required' => 'Debe ingresar contenido',
            'id_usuario.required' => 'Debe ingresar el id del usuario',
            'id_video.required' => 'Debe ingresar el id del video',

        ]);

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
        $request->validate([
            'contenido' => 'required|max:200',
            'id_usuario' => 'required',
            'id_video' => 'required',
        ],[ //Mensajes de error abajo
            'contenido.required' => 'Debe ingresar contenido',
            'id_usuario.required' => 'Debe ingresar el id del usuario',
            'id_video.required' => 'Debe ingresar el id del video',

        ]);

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
