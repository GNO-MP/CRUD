<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\storage; //funciones de borrado

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['productos']=Producto::paginate(2);
        return view('producto.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('producto.create');
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

        $campos=[
            'Nombre'=>'required|string|max:100',
            'Descripcion'=>'required|string|max:300',
            'Cantidad'=>'required|integer',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',      //":" es comodin
            'Foto.required'=>'Es necesaria una Foto'
        ];

        $this->validate($request,$campos,$mensaje);


        $datosProducto = request()->except('_token');

        
        //agregar fotos al proyecto
        if($request->hasfile('Foto')){
            $datosProducto['Foto']=$request->file('Foto')->store('uploads','public');
        }
        
        Producto::insert($datosProducto);
        return redirect('producto')->with('mensaje','Producto agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        $producto=Producto::findOrFail($id);
        return view('producto.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

        $campos=[
            'Nombre'=>'required|string|max:100',
            'Descripcion'=>'required|string|max:300',
            'Cantidad'=>'required|integer',
         
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',      //":" es comodin
           
        ];

        if($request->hasfile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg',];
            $mensaje=['Foto.required'=>'Es necesaria una Foto'];
        }
        $this->validate($request,$campos,$mensaje);

        //
        $datosProducto = request()->except(['_token','_method']);

        /*
        OBTENER LA IMAGEN Y ACTUALIZARLA
        */
        if($request->hasfile('Foto')){
            $producto=Producto::findOrFail($id);
            Storage::delete('public/'.$producto->Foto);
            $datosProducto['Foto']=$request->file('Foto')->store('uploads','public');
        }
        
        
        Producto::where('id','=',$id)->update($datosProducto);
        $producto=Producto::findOrFail($id);
        return redirect('producto')->with('mensaje','Producto Actualizado');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        
        $producto=Producto::findOrFail($id);
        
        if(Storage::delete('public/'.$producto->Foto)){    //cuando existe una foto
             Producto::destroy($id);
        }
        
        Producto::destroy($id);
       
        return redirect('producto')->with('mensaje','Producto Borrado');

    }
}
