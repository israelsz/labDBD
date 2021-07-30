<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlaylistVideo;
use Illuminate\Support\Facades\Validator;

class PlaylistVideoController extends Controller
{
    public function index()
    {
        //Se traen todas las tuplas de la tabla intermedia PlaylistVideo de la base de datos
        $playlistVideos = PlaylistVideo::all();

        //Se verifica en caso este vacia
        if($playlistVideos == NULL){
            return "No existe ninguna tupla intermedia playlist-video.";
        }
        //Se retornan las tuplas de la tabla intermedia PlaylistVideo en formato json
        return response()->json($playlistVideos);
    }

    //Guarda una nueva tupla-> Create
    public function store(Request $request)
    {
        $playlistVideo = new PlaylistVideo();

        $validarDatos = Validator::make($request->all(),[
            'id_playlist' => 'required',
            'id_video' => 'required',
        ],[ //Mensajes de error abajo
            'id_playlist.required' => 'Debe ingresar el id de la playlist',
            'id_video.required' => 'Debe ingresar el id del video de la playlist',
        ]);
        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }

        $playlistVideo->id_playlist = $request->id_playlist;
        $playlistVideo->id_video = $request->id_video;
        $playlistVideo->save();

        return response()->json([
            "message" => "Se ha generado una nueva tupla en la tabla intermedia playlist-video",
            "id" => $playlistVideo->id
        ]);
    }

    //Muestra solo una tupla, según su id -> Read
    public function show($id)
    {
        $playlistVideo = PlaylistVideo::find($id);
        if($playlistVideo == NULL){
            return "No existe ninguna tupla de la tabla intermedia playlist-video con ese id";
        }

        return response()->json($playlistVideo);
    }


    //Actualiza una tupla -> Update
    public function update(Request $request, $id)
    {
        $playlistVideo = PlaylistVideo::find($id);
        
        if($playlistVideo == NULL){
            return "No existe ninguna tupla de la tabla intermedia playlist-video con ese id";
        }

        $validarDatos = Validator::make($request->all(),[
            'id_playlist' => 'required',
            'id_video' => 'required',
        ],[ //Mensajes de error abajo
            'id_playlist.required' => 'Debe ingresar el id de la playlist',
            'id_video.required' => 'Debe ingresar el id del video de la playlist',
        ]);
        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }

        $playlistVideo->id_playlist = $request->id_playlist;
        $playlistVideo->id_video = $request->id_video;

        $playlistVideo->save();
        return response()->json($playlistVideo);
    }

    //Borra una tupla -> Delete
    public function destroy($id)
    {
        $playlistVideo = PlaylistVideo::find($id);
        
        if($playlistVideo == NULL){
            return "No existe ninguna tupla intermedia playlist-video con ese id";
        }

        $playlistVideo->delete();
        return response()->json([
            "message" => "Se ha borrado la tupla de la tabla intermedia playlist-video",
            "id" => $playlistVideo->id
        ]);
    }
}