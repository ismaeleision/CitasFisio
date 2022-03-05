<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Cart;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        return view('tienda', ['productos' => $productos]);
    }
    public function indexPublic()
    {
        redirect('tienda');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createProducto');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->descripcion = $request->descripcion;
        $producto->imagen = '';
        $producto->save();

        //$path = $request->file('imagen')->store('public');
        $path = $request->file('imagen')->storeAs(
            'public',
            $producto->id . '.jpg'
        );

        $producto->imagen = asset('storage/' . $producto->id . '.jpg');
        $producto->save();

        $productos = Producto::all();
        return view('tienda', ['productos' => $productos]);
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
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }


    public function addCarro($id)
    {
        $userID = Auth::id();
        $producto = Producto::find($id);

        \Cart::session($userID)->add(array(
            'id' => $producto->id,
            'name' => $producto->nombre,
            'price' => $producto->precio,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $producto
        ));

        return back();
    }

    /**
     * Saca la cantidad del objeto en el carrito 
     * Segun la cantidad o quita uno o lo borra si la cantidad es 1
     */
    public function quitar1Carro($id)
    {
        $userID = Auth::id();

        //Sacar la cantidad del objeto en el carro
        $items = \Cart::session($userID)->getContent($id);
        $items = $items[1]->quantity;

        if ($items > 1) {
            \Cart::session($userID)->update($id, [
                'quantity' => -1,

            ]);
        } else {
            \Cart::session($userID)->remove($id);
        }

        $items = \Cart::getContent();
        return view('verCarro', ['items' => $items]);
    }

    public function verCarro()
    {
        $userID = Auth::id();
        \Cart::session($userID);

        $items = \Cart::getContent();
        return view('verCarro', ['items' => $items]);
    }

    public function quitarCarro($id)
    {
        $userID = Auth::id();
        \Cart::session($userID)->remove($id);

        $items = \Cart::getContent();
        return view('verCarro', ['items' => $items]);
    }
}
