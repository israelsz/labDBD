<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Validator;

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
        $dioFeedback = Feedback::all()
                        -> where('id_usuario', $request->id_usuario)
                        -> where('id_video', $request->id_video)->first();

        if (empty($dioFeedback)){
            $feedback = new Feedback();
            $feedback->tipo_valoracion = $request->tipo_valoracion;
            $feedback->id_usuario = $request->id_usuario;
            $feedback->id_video = $request->id_video;
            $feedback->save();
            return back();
        }
        $feedback = Feedback::find($dioFeedback->id);
        $feedback->delete();
        $feedback = new Feedback();
        $feedback->tipo_valoracion = $request->tipo_valoracion;
        $feedback->id_usuario = $request->id_usuario;
        $feedback->id_video = $request->id_video;
        $feedback->save();
        return back();
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
        $validarDatos = Validator::make($request->all(),[
            'tipo_valoracion' => 'required',
            'id_usuario' => 'required',
            'id_video' => 'required',
        ],[ //Mensajes de error abajo
            'tipo_valoracion.required' => 'Debe ingresar una valoracion 1 o 0',
            'id_usuario.required' => 'Debe ingresar el id el usuario que dió la valoración',
            'id_video.required' => 'Debe ingresar el id del video que recibió la valoración',
        ]);
        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }

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