<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Cart;
use Carbon\Carbon;

class PedidoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //El admin puede verlas todas
        if (Auth::user()->role == 'admin') {
            $pedidos = Pedido::paginate(5);
        } else {
            //Sacar id de usuario autenticado
            $id = Auth::id();
            //Sacar los pedidos del usuario que se ha logueado
            $pedidos = Pedido::where('user_id', $id)->paginate(5);
        }

        return view('pedidos', ['pedidos' => $pedidos]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = Pedido::find($id);
        $this->authorize('view', $pedido);

        $productos = $pedido->productos;
        $total = 0;
        foreach ($productos as $producto) {
            $total += $producto->precio * $producto->pivot->cantidad;
        }

        return view('pedidoDetalle', ['pedido' => $pedido, 'productos' => $productos, 'total' => $total]);
    }



    public function hacerPedido()
    {
        //Sacar de la sesión el carro de la compra
        $userID = Auth::id();
        \Cart::session($userID);
        $items = \Cart::getContent();

        //Creamos el pedido
        $pedido = new Pedido();
        $pedido->fecha = Carbon::now()->toDateString();
        $pedido->estado = 'enproceso';
        $pedido->gastos_envio = 10;
        $pedido->user_id = $userID;
        $pedido->save();

        //Añadimos los productos del carro al pedido
        foreach ($items as $item) {
            $id = $item->id;
            $pedido->productos()->attach($id, ['cantidad' => $item->quantity]);
        }

        //Vaciar el carro de la compra
        \Cart::session($userID)->clear();

        //Habría que redirigir a una página estática diciendo que se ha hecho el pedido
        return redirect('/tienda');
    }
}
