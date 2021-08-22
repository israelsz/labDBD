<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlaylistController extends Controller
{

    public function index()
    {
        //Se traen todas las playlist de la tabla playlists de la base de datos
        $playlists = Playlist::all();

        //Se verifica en caso este vacia
        if($playlists == NULL){
            return "No existen playlists.";
        }
        //Se retornan las playlist en formato json
        return response()->json($playlists);
    }

    //Guarda una nueva playlist-> Create
    public function store(Request $request)
    {
        $playlist = new Playlist();

        $validarDatos = Validator::make($request->all(),[
            'nombre_playlist' => 'required|max:60',
            'descripcion_playlist' => 'required|max:500',
        ],[ //Mensajes de error abajo
            'nombre_playlist.required' => 'Debe ingresar un nombre a la playlist',
            'nombre_playlist.max' => 'No puede exceder mas de 60 caracteres',
            'descripcion_playlist.required' => 'Debe ingresar una descripcion a la playlist',
            'descripcion_playlist.max' => 'No puede exceder mas de 500 caracteres',
        ]);
        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }

        $playlist->nombre_playlist = $request->nombre_playlist;
        $playlist->descripcion_playlist = $request->descripcion_playlist;
        $playlist->save();

        return back();
    }

    //Muestra solo una playlist, según su id -> Read
    public function show($id)
    {
        $playlist = Playlist::find($id);
        if($playlist == NULL){
            return "No existe una playlist asociada a ese id";
        }

        return response()->json($playlist);
    }


    //Actualiza una playlist -> Update
    public function update(Request $request, $id)
    {
        $playlist = Playlist::find($id);
        
        if($playlist == NULL){
            return "No existe una playlist asociada a ese id";
        }
        $validarDatos = Validator::make($request->all(),[
            'nombre_playlist' => 'required|max:60',
            'descripcion_playlist' => 'required|max:500',
        ],[ //Mensajes de error abajo
            'nombre_playlist.required' => 'Debe ingresar un nombre a la playlist',
            'nombre_playlist.max' => 'No puede exceder mas de 60 caracteres',
            'descripcion_playlist.required' => 'Debe ingresar una descripcion a la playlist',
            'descripcion_playlist.max' => 'No puede exceder mas de 500 caracteres',
        ]);
        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }
        $playlist->nombre_playlist = $request->nombre_playlist;
        $playlist->descripcion_playlist = $request->descripcion_playlist;

        $playlist->save();
        return response()->json($playlist);
    }

    //Borra una playlist -> Delete
    public function destroy($id)
    {
        $playlist = Playlist::findOrFail($id);
        $playlist->delete();
        return back()->with('register','Playlist Eliminada!');
    }
}
