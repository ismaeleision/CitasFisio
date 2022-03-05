<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;

class ServicioController extends Controller
{


    public function index()
    {
        $this->authorize('viewAny', Servicio::class);

        $servicios = Servicio::all();
        return view('servicios', ['servicios' => $servicios]);
    }

    public function indexPublic()
    {
        $servicios = Servicio::all();
        return view('servicios', ['servicios' => $servicios]);
    }

    public function destroy($id)
    {
        //Si hay citas con ese servicio contratado no puedo borrarlo.
        $serviciosUsados = Cita::where('servicio_id', $id)->count();

        if ($serviciosUsados == 0) {
            $servicio = Servicio::find($id);
            Servicio::destroy($id);
        }

        $servicios = Servicio::all();
        return view('servicios', ['servicios' => $servicios]);
    }

    public function create()
    {
        return view('createServicio');
    }

    public function store(Request $request)
    {
        $servicio = new Servicio;
        $servicio->servicios = $request->servicios;
        $servicio->imagen = '';
        $servicio->save();

        //$path = $request->file('imagen')->store('public');
        $path = $request->file('imagen')->storeAs(
            'public',
            $servicio->id . '.jpg'
        );

        $servicio->imagen = asset('storage/' . $servicio->id . '.jpg');
        $servicio->save();

        $servicios = Servicio::all();
        return view('welcome', ['servicios' => $servicios]);
    }
}
