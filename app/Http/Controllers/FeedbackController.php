<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        //Se traen todas las valoraciones de la tabla feedbacks de la base de datos
        $feedbacks = Feedback::all();

        //Se verifica en caso este vacia
        if($feedbacks == NULL){
            return "Aún no se realizan valoraciones.";
        }
        //Se retornan las valoraciones en formato json
        return response()->json($feedbacks);
    }

    //Guarda una nueva valoracion-> Create
    public function store(Request $request)
    {
        $feedback = new Feedback();

        $request->validate([
            'tipo_valoracion' => 'required',
            'id_usuario' => 'required',
            'id_video' => 'required',
        ],[ //Mensajes de error abajo
            'tipo_valoracion.required' => 'Debe ingresar una valoracion 1 o 0',
            'id_usuario.required' => 'Debe ingresar el id el usuario que dió la valoración',
            'id_video.required' => 'Debe ingresar el id del video que recibió la valoración',
        ]);

        $feedback->tipo_valoracion = $request->tipo_valoracion;
        $feedback->id_usuario = $request->id_usuario;
        $feedback->id_video = $request->id_video;
        $feedback->save();

        return response()->json([
            "message" => "Se ha generado una nueva valoración",
            "id" => $feedback->id
        ]);
    }

    //Muestra solo una valoración, según su id -> Read
    public function show($id)
    {
        $feedback = Feedback::find($id);
        if($feedback == NULL){
            return "No existe ninguna valoración con ese id";
        }

        return response()->json($feedback);
    }


    //Actualiza una valoración -> Update
    public function update(Request $request, $id)
    {
        $feedback = Feedback::find($id);
        
        if($feedback == NULL){
            return "No existe ninguna valoración con ese id";
        }
        $request->validate([
            'tipo_valoracion' => 'required',
            'id_usuario' => 'required',
            'id_video' => 'required',
        ],[ //Mensajes de error abajo
            'tipo_valoracion.required' => 'Debe ingresar una valoracion 1 o 0',
            'id_usuario.required' => 'Debe ingresar el id el usuario que dió la valoración',
            'id_video.required' => 'Debe ingresar el id del video que recibió la valoración',
        ]);

        $feedback->tipo_valoracion = $request->tipo_valoracion;
        $feedback->id_usuario = $request->id_usuario;
        $feedback->id_video = $request->id_video;

        $feedback->save();
        return response()->json($feedback);
    }

    //Borra una valoración -> Delete
    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        
        if($feedback == NULL){
            return "No existe ninguna valoración con ese id";
        }

        $feedback->delete();
        return response()->json([
            "message" => "Se ha borrado la valoración",
            "id" => $feedback->id
        ]);
    }
}