<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        //Almacenar todos las categorias
        $categorias = Category::all();

        //Indicar con un mensaje en el caso de que no existan categorias
        if (empty($categorias)){
            return "No existen categorias";
        }
        //Entregar las categorias 
        return $categorias;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Crear una nueva categoria
        $categoria= new Category();

        $validarDatos = Validator::make($request->all(),
            ['nombre_categoria'=> 'required|max:20'],
            ['nombre_categoria.required'=> 'Debe ingresar un nombre de categoria']
        );

        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }
        
        $categoria->nombre_categoria = $request->nombre_categoria;

        $categoria->save();

        return back()->with('mensaje','categoria creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
        //
        $categoria = Category::find($id);
        return $categoria;
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
        $categoria = Category::findOrFail($id);


        $validarDatos = Validator::make($request->all(),
            ['nombre_categoria'=> 'required|max:60'],
            ['nombre_categoria.required'=> 'Debe ingresar un nombre de categoria']
        );
        
        if ($validarDatos->fails()){
            return response()->with('mensaje',' Fallo');
        }

        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->save();

        return back()->with('mensaje','Categoria actualizada');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Category::findOrFail($id);

        $categoria->delete();
        return back()->with('mensaje','Categoria Borrada');
        
    }
}
