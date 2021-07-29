<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoCategory;

class VideoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $videoCategoria = videoCategory::all();

        if ($videoCategoria==NULL) {
            return "No exite ninguna tupla intermedia entre video-categoria";
        }
        return response()->json($videoCategoria);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $videoCategoria = new VideoCategoria();
        $request->validate([
                'id_video'=>'required',
                'id_categoria'=>'required'
            ],[
                'id_video.required'=> 'Debe ingresar el id del video',
                'id_categoria.required'=>'Debe ingresar el id de  la categoria'
            ]);

        $videoCategoria->id_video= $request->id_video;
        $videoCategoria->id_categoria= $request->id_categoria;
        $videoCategoria->save();
        return response()->json([
            "message"=> "Se ha creado un nuevo video-categoria",
            $videoCategoria
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $videoCategoria= VideoCategory::find($id);
        if ($videoCategoria==NULL) {
            return "No existe la tupla vido-categoria con esa id";
        }

        return response()->json($videoCategoria);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $videoCategoria= VideoCategory::find($id);
        if ($videoCategoria==NULL) {
            return "No existe la tupla vido-categoria con esa id";
        }

        $request->validate([
            'id_video'=>'required',
            'id_categoria'=>'required'
        ],[
            'id_video.required'=> 'Debe ingresar el id del video',
            'id_categoria.required'=>'Debe ingresar el id de  la categoria'
        ]);

        $videoCategoria->id_video= $request->id_video;
        $videoCategoria->id_categoria= $request->id_categoria;
        $videoCategoria->save();
        return response()->json([
            "message"=> "Se ha actualizado un video-categoria",
            $videoCategoria
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $videoCategoria=VideoCategoria::find($id);

        if ($videoCategoria==NULL) {
            return "No existe la tupla video-categoria asociada con la id";
        }

        $videoCategoria->delete();
        return response()->json(
            [
                "message"=>"Se ha borrado la categoria",
                "id"=>$videoCategoria->id
            ]
            );
    }
}
