<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\EditUserController;
use App\Models\Commune;
use App\Models\Playlist;
use App\Models\PlaylistVideo;
use App\Models\Video;
use App\Models\UserPlaylist;

class ViewsController extends Controller
{   
    //Vista indice
    public function vistaIndice(){
        
        return view('index');
    }

    //Vista login
    public function vistaLogin(){

        return view('login');
    }

    //Vista Register
    public function vistaRegister(){
        //Se consiguen las comunas desde la base de datos
        $comunas = CommuneController::index();

        return view('register',compact('comunas'));
    }

    public function vistaEditarUsuario($user){
        $usuario=User::findOrFail($user);
        $comunas = CommuneController::index();
        $comuna_usuario=Commune::find($usuario->id_comuna);

        return view('editUser',compact('comunas','usuario','comuna_usuario'));
    }

    public function vistaUsuario($id){
        $user=User::find($id);
        $comunas = CommuneController::index();
        $comuna=Commune::find($user->id_comuna);
        return view('userView',compact('user','comuna'));
    }

    //Vista My videos
    public function vistaMyVideos(){
        //$userOn = Auth::user();
        $videosUser =  VideoController::index();
        /*
        $videosUser = array();
        if(!empty($userOn)){
            foreach($videos as $vid){
                if($vid->id_usuario_autor == $userOn->id){
                    array_push($videosUser,$vid);
                }

            }
        }
        */
        return view('myvideos',compact('videosUser'));
    }
    //Vista My videos
    public function vistaEditVideo($id){
        $video =  VideoController::show($id);
        return view('editvideo',compact('video'));
    }

    public function vistaTopVideos(){
        $videos =  VideoController::ordenadosViews();
        return view('topvideos',compact('videos'));
    }
    public function actualizarVideo(Request $datos, $idVideo){
        //Se busca al usuario segun su id
        $videoActualizar = VideoController::show($idVideo);

        //Se actualizan sus datos de acuerdo al formulario
        $videoActualizar->titulo_video = $datos->titulo_video;
        $videoActualizar->descripcion = $datos->descripcion;

        //Se guardan los cambios en la base de datos
        $videoActualizar->save();

        //Se regresa a la vista anterior
        return redirect()->action([ViewsController::class, 'vistaMyVideos'])->with('mensaje', 'Video actualizado!');
    }

    public function vistaListaReproduccion(){
        $listas=Playlist::all();
        return view('playlistView',compact('listas'));
         
    }

    public function vistaVideoListaReproduccion($id){
        $auxs= PlaylistVideo::all()->where('id_playlist',$id);
        $videos=Video::all();
        $videosFiltrados=array();
        foreach ($auxs as $aux){
            foreach ($videos as $video){
                if ($aux->id_video==$video->id) {
                    array_push($videosFiltrados,$video);
                }
            }
        }
        $autores = UserPlaylist::select('id_usuario')->where('id_playlist',$id)->get();

        return view('playlistVideoView',compact('videosFiltrados','autores','id'));
        
    }   

    public function vistaAgregarListaReproduccion(){
        $videos=Video::all();
        return view('createPlaylist',compact('videos'));
    }

    public function agregarListaReproduccion($id_usuario,Request $request){

        $playlist= new Playlist();
        $playlist->nombre_playlist = $request->nombre_playlist;
        $playlist->descripcion_playlist = $request->descripcion_playlist;
        $playlist->save();
        $userPlaylist= new UserPlaylist();
        $userPlaylist->id_playlist = $playlist->id;
        $userPlaylist->id_usuario = $id_usuario;
        $userPlaylist->save();
        
        $videos = $request->input('check_videos');
        foreach ($videos as $video){

            $playlistVideo = new PlaylistVideo();
            $playlistVideo->id_playlist = $playlist->id;
            $playlistVideo->id_video = $video;
            $playlistVideo->save();
        }
        return redirect(route('vistaListaReproduccion'));
    
    }
    
    public function vistaEditarPlaylist($id){
        $playlist=Playlist::find($id);

        $videos=Video::all();
        $video_checked=PlaylistVideo::select('id_video')->where('id_playlist',$id)->get();
        $seleccionados=array();
        foreach ($video_checked as $ckecked){

            array_push($seleccionados,$ckecked->id_video);
        }
        
        return view('editPlaylistView',compact('playlist','videos','seleccionados'));
    }

    public function editarPlaylist($id, Request $request){


        $playlist= Playlist::find($id);
        
    
        if ($request->nombre_playlist!=null) {
            $playlist->nombre_playlist = $request->nombre_playlist;
        }
           
        if ($request->descripcion_playlist!=null) {
            $playlist->descripcion_playlist = $request->descripcion_playlist;
        }
        
        $playlist->save();

        $videos_para_cambiar = $request->input('check_videos_edit');
        $videos_originales = PlaylistVideo::all()->where('id_playlist',$id);
        
    
        if($videos_originales!=null){
            foreach ($videos_originales as $video_original){
                PlaylistVideo::destroy($video_original->id);
            }
        }

        if($videos_para_cambiar!=null){
            foreach($videos_para_cambiar as $video_cambiar){
                $playlistVideo = new PlaylistVideo();
                $playlistVideo->id_playlist = $playlist->id;
                $playlistVideo->id_video = $video_cambiar;
                $playlistVideo->save();
            }
        }
        return redirect(route('vistaListaReproduccion'));
    }
}