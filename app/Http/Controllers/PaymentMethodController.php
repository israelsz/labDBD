<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Se traen todos los metodo de pago de la base de datos
        $metodoPago = PaymentMethod::all();

        //Se verifica en caso este vacia
        if($metodoPago == NULL){
            return "No existen metodo de pago";
        }
        return response()->json($metodoPago);
    }

    public function store(Request $request)
    {
        $metodoPago = new PaymentMethod();
        $validarDatos = Validator::make($request->all(),[
            'nombre_metodo_pago' => 'required|max:100'
        ],[
            'nombre_metodo_pago.required' => 'Debe ingresar el nombre del metodo de pago',
            'nombre_metodo_pago.max:100' => 'El nombre del metodo de pago no debe exceder los 100 caracteres'
        ]);

        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }

        $metodoPago->nombre_metodo_pago = $request->nombre_metodo_pago;
        $metodoPago->save();
        return back()->with('mensaje','Metodo Creado');
    }

    public function show($id)
    {
        $metodoPago = PaymentMethod::find($id);
        
        if($metodoPago == NULL){
            return "No existe un metodo de pago asociado a ese id";
        }

        return $metodoPago;
    }
    public function update(Request $request, $id)
    {
        $metodoPago = PaymentMethod::find($id);
        if($metodoPago == NULL){
            return "No existe un metodo de pago asociada a ese id";
        }
        $validarDatos = Validator::make($request->all(),[
            'nombre_metodo_pago' => 'required|max:100'
        ],[
            'nombre_metodo_pago.required' => 'Debe ingresar el nombre del metodo de pago',
            'nombre_metodo_pago.max:100' => 'El nombre del metodo de pago no puede exceder los 100 caracteres'

        ]);
        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }

        $metodoPago->nombre_metodo_pago = $request->nombre_metodo_pago;
        $metodoPago->save();
        return back()->with('mensaje','Metodo actualizado');
    }

    public function destroy($id)
    {
        $metodoPago = PaymentMethod::find($id);
        
        if($metodoPago == NULL){
            return "No existe un metodo de pago asociado a ese id";
        }
        $metodoPago->delete();
        return back()->with('mensaje','Video Borrado');
    }
}
