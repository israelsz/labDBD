<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Validator;
class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donaciones = Donation::all();

        //Indicar con un mensaje en el caso de que no existan donaciones
        if ($donaciones == NULL){
            return response()->json(["message"=> "No exiten donaciones"],404);
        }
        //Entregar las donaciones 
        return response()->json($donaciones);
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
        $donacion= new Donation();

    

        $validarDatos = Validator::make($request->all(),
            [
                'monto'=>'required',
                'fecha_donacion'=>'required',
                'id_donador'=>'required',
                'id_receptor'=>'required',
                'id_metodo_pago'=>'required',
                'id_playlist'=>'required',
                'id_video'=>'required'
            ],
            
            [
                'monto.required'=>'Se debre ingresar un monto de la donacion',
                'fecha_donacion.required'=>'Se debre ingresar una fecha de donacion',
                'id_donador.required'=>'Se debre ingresar una id de donador',
                'id_receptor.required'=>'Se debre ingresar una id de receptor',
                'id_metodo_pago.required'=>'Se debre ingresar una id de metodo de pago',
                'id_playlist.required'=>'Se debre ingresar id de lista de reproduccion',
                'id_video.required'=>'Se debre ingresar de video'   
            ]
            
        
            );
   
        if ($validarDatos->fails()){
            return back()->with('createDonationsError', $validarDatos->errors());
        }
        
        $donacion->monto = $request->monto;
        $donacion->fecha_donacion= $request->fecha_donacion;
        $donacion->id_donador= $request->id_donador;
        $donacion->id_receptor= $request->id_receptor;
        $donacion->id_metodo_pago= $request->id_metodo_pago;
        $donacion->id_playlist= $request->id_playlist;
        $donacion->id_video= $request->id_video;
        $donacion->save();

        return redirect()->route('vistaCrudAdmin')->with('register','Se registrado una nueva donacion!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $donacion= Donation::find($id);

        if ($donacion==NULL) {
            return response()->json(["message"=> "No exiten donaciones asociadas a la id ingresada"],404);
        }

        return response()->json($donacion);
    
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
        $donacion= Donation::find($id);

        if ($donacion==NULL) {
            return back()->with('createDonationsError', $validarDatos->errors());
        }

        $validarDatos = Validator::make($request->all(),
            [
                'monto'=>'required',
                'fecha_donacion'=>'required',
                'id_donador'=>'required',
                'id_receptor'=>'required',
                'id_metodo_pago'=>'required',
                'id_playlist'=>'required',
                'id_video'=>'required'
            ],
            [
                'monto.required'=>'Se debre ingresar un monto de la donacion',
                'fecha_donacion.required'=>'Se debre ingresar una fecha de donacion',
                'id_donador.required'=>'Se debre ingresar una id de donador',
                'id_receptor.required'=>'Se debre ingresar una id de receptor',
                'id_metodo_pago.required'=>'Se debre ingresar una id de metodo de pago',
                'id_playlist.required'=>'Se debre ingresar id de lista de reproduccion',
                'id_video.required'=>'Se debre ingresar de video'   
            ]
        
        );

        
        
        $donacion->monto = $request->monto;
        $donacion->fecha_donacion= $request->fecha_donacion;
        $donacion->id_donador= $request->id_donador;
        $donacion->id_receptor= $request->id_receptor;
        $donacion->id_metodo_pago= $request->id_metodo_pago;
        $donacion->id_playlist= $request->id_playlist;
        $donacion->id_video= $request->id_video;
        $donacion->save();

        
        return redirect()->route('vistaCrudAdmin')->with('register','Se editado una donacion!');

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
        $donacion= Donation::find($id);

        if ($donacion==NULL) {
            return back()->with('deleteDonationsError', 'Ha existido un error al elimina la donacion');
        }

        $donacion->delete();
        return redirect()->route('vistaCrudAdmin')->with('register','Se eliminado una donacion!');
    }
}
