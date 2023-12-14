<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Compra;
use App\Models\Area;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras= Compra::all();

        return view('dashboard.compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::select('nombre_area')->distinct()->get();
        //return Area::select('servicio')->where('nombre_area','=','Mapachio')->get();
        return view('dashboard.compras.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_documento'=>'bail|required',
            'fecha_documento'=>'required',
            'proveedor'=>'required|string|max:255',
            'servicio'=>'required|string|max:255',
            'proyecto'=>'required|string|max:255',
            'tipo_cambio' => 'numeric',
            'total'=>'required|numeric',
            'pagado'=>'required|numeric',
            'fecha_pago'=>'required',
            'detalle_pago'=>'required|string'
        ]);
        Compra::create($request->all());
        $compras= Compra::all();
        return view('dashboard.compras.index',compact('compras'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
        $areas = Area::select('nombre_area')->distinct()->get();
        return view('dashboard.compras.edit',compact('compra','areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        $request->validate([
            'numero_documento'=>'bail|required',
            'fecha_documento'=>'required',
            'proveedor'=>'required|string|max:255',
            'servicio'=>'required|string|max:255',
            'proyecto'=>'required|string|max:255',
            'tipo_cambio' => 'numeric',
            'total'=>'required|numeric',
            'pagado'=>'required|numeric',
            'fecha_pago'=>'required',
            'detalle_pago'=>'required|string'
        ]);
        $compra->update($request->all());
        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'asombroso!',
            'text'=>'La compra ha sido actualizada!',
        ]);
        $compras= Compra::all();
        return view('dashboard.compras.index',compact('compras'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getOptions($selectedValue){
        $opciones=Area::select('servicio')->where('nombre_area','=',$selectedValue)->get();
        return response()->json($opciones);
    }
}
