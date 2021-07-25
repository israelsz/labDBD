<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        //Se traen todas los videos de la tabla de la base de datos
        $videos = Video::all();

        //Se verifica en caso este vacia
        if($videos == NULL){
            return "No existen videos.";
        }
        return response()->json($videos);
    }

    public function store(Request $request)
    {
        $video = new Video();

        $request->validate([
            'direccion_video' => 'required|max:100',
            'titulo_video' => 'required|max:60',
            'visitas' => 'required',
            'restriccion_edad' => 'required',
            'popularidad' => 'required',
            'cantidad_temporadas' => 'required',
            'descripcion' => 'required|max:500',
            'id_usuario_autor' => 'required',
            'id_comuna' => 'required'
        ],[ //Mensajes de error abajo
            'direccion_video.required' => 'Debe ingresar una direccion de video',
            'direccion_video.max' => 'No puede exceder mas de 100 caracteres',
            'titulo_video.required' => 'Debe ingresar el titulo del video',
            'visitas.required' => 'Debe ingresar el numero de visitas',
            'restriccion_edad.required' => 'Debe ingresar la restriccion de edad 1 o 0',
            'popularidad.required' => 'Debe ingresar el flotante de popularidad entre 0-1',
            'cantidad_temporadas.required' => 'Debe ingresar la cantidad de temporadas',
            'descripcion.required' => 'Debe ingresar la descripcion del video',
            'descripcion.max' => 'La descripcion del video no puede exceder 500 caracteres',
            'id_usuario_autor.required' => 'Debe ingresar el id del usuario que subio el video',
            'id_comuna.required' => 'Debe ingresar el id de la comuna al que pertenece el video'
        ]);

        $video->direccion_video = $request->direccion_video;
        $video->titulo_video = $request->titulo_video;
        $video->visitas= $request->visitas;
        $video->restriccion_edad = $request->restriccion_edad;
        $video->popularidad = $request->popularidad;
        $video->cantidad_temporadas = $request->cantidad_temporadas;
        $video->descripcion = $request->descripcion;
        $video->id_usuario_autor= $request->id_usuario_autor;
        $video->id_comuna = $request->id_comuna;

        $video->save();

        return response()->json([
            "message" => "Se ha creado un nuevo video",
            "id" => $video->id
        ]);
    }

    public function show($id)
    {
        $video = Video::find($id);
        
        if($video == NULL){
            return "No existe un video asociado a ese id";
        }

        return response()->json($video);
    }

    public function update(Request $request, $id)
    {
        $video = Video::find($id);
        
        if($video == NULL){
            return "No existe un video asociada a ese id";
        }

        $request->validate([
            'direccion_video' => 'required|max:100',
            'titulo_video' => 'required|max:60',
            'visitas' => 'required',
            'restriccion_edad' => 'required',
            'popularidad' => 'required',
            'cantidad_temporadas' => 'required',
            'descripcion' => 'required|max:500',
            'id_usuario_autor' => 'required',
            'id_comuna' => 'required'
        ],[ //Mensajes de error abajo
            'direccion_video.required' => 'Debe ingresar una direccion de video',
            'direccion_video.max' => 'No puede exceder mas de 100 caracteres',
            'titulo_video.required' => 'Debe ingresar el titulo del video',
            'visitas.required' => 'Debe ingresar el numero de visitas',
            'restriccion_edad.required' => 'Debe ingresar la restriccion de edad 1 o 0',
            'popularidad.required' => 'Debe ingresar el flotante de popularidad entre 0-1',
            'cantidad_temporadas.required' => 'Debe ingresar la cantidad de temporadas',
            'descripcion.required' => 'Debe ingresar la descripcion del video',
            'descripcion.max' => 'La descripcion del video no puede exceder 500 caracteres',
            'id_usuario_autor.required' => 'Debe ingresar el id del usuario que subio el video',
            'id_comuna.required' => 'Debe ingresar el id de la comuna al que pertenece el video'
        ]);

        $video->direccion_video = $request->direccion_video;
        $video->titulo_video = $request->titulo_video;
        $video->visitas= $request->visitas;
        $video->restriccion_edad = $request->restriccion_edad;
        $video->popularidad = $request->popularidad;
        $video->cantidad_temporadas = $request->cantidad_temporadas;
        $video->descripcion = $request->descripcion;
        $video->id_usuario_autor= $request->id_usuario_autor;
        $video->id_comuna = $request->id_comuna;

        $video->save();
        return response()->json($video);
    }

    public function destroy($id)
    {
        $video = Video::find($id);
        
        if($video == NULL){
            return "No existe un video asociado a ese id";
        }

        $video->delete();
        return response()->json([
            "message" => "Se ha borrado el video",
            "id" => $video->id
        ]);
    }
}
