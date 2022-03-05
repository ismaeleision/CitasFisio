<?php

namespace App\Http\Controllers;

use App\Models\Hora;
use App\Models\Cita;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CitaController extends Controller
{
    /**
     * Display horas libres en una fecha
     *
     * @return \Illuminate\Http\Response
     */
    public function horasDisp($fecha)
    {
        //Sacar las horas libres esa fecha
        $horasLibres = Hora::select('hora')->whereNotIn('hora', Cita::select('hora')->where('fecha', $fecha)->get())->get();
        foreach ($horasLibres as $hora) {
            echo "<option value='{$hora->hora}'>{$hora->hora}:00</option>";
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $citas = Cita::where('user_id', $id)->paginate(7);
        return view('dashboard', ['citas' => $citas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horas = Hora::all();
        $servicios = Servicio::all();
        return view('createCita', ['servicios' => $servicios, 'horas' => $horas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Insercción
        $cita = new Cita;
        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;
        $cita->observaciones = $request->observaciones;
        $cita->servicio_id = $request->servicio;
        $cita->user_id = Auth::id();
        $cita->save();
        return redirect()->route('citas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function show(cita $cita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cita = Cita::find($id);
        $servicios = Servicio::all();
        //Sacar las horas libres esa fecha
        $horas = Cita::select('hora')->where('fecha', $cita->fecha)->get();
        $horasTotales = collect(['hora' => 10, 'hora' => 11, 'hora' => 12, 'hora' => 13, 'hora' => 17, 'hora' => 18, 'hora' => 19, 'hora' => 20]);
        $horasLibres = $horasTotales->diffAssoc($horas);
        var_dump($horas);
        return view('editCita', ['cita' => $cita, 'servicios' => $servicios]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cita $cita, $id)
    {
        //Validación
        $validated = $request->validate([
            'observaciones' => 'required|max:255',
            'fecha' => 'required|min:'
        ]);

        //Modificación
        $cita = Cita::find($id);
        if ($cita->user_id == Auth::id()) {
            $cita->fecha = $request->fecha;
            $cita->hora = $request->hora;
            $cita->observaciones = $request->observaciones;
            $cita->servicio_id = $request->servicio;
            $cita->user_id = Auth::id();
            $cita->save();
        } else {
            abort(403);
        }

        return redirect()->route('citas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cita = Cita::find($id);
        if ($cita->user_id == Auth::id()) {
            Cita::destroy($id);
        } else {
            abort(403);
        }
        return redirect()->route('citas.index');
    }

    /**
     *  Crear cita a través de la API 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createApi(Request $request)
    {
        $hoy = Carbon::now();

        //Validación
        $validated = $request->validate([
            'observaciones' => 'required|max:255',
            'fecha' => 'required|after:today'
        ]);

        //Insercción
        $cita = new Cita;
        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;
        $cita->observaciones = $request->observaciones;
        $cita->servicio_id = $request->servicio;
        $cita->user_id = Auth::id();
        $cita->save();

        return response()->json([
            'message' => 'Cita creada correctamente'
        ]);
    }

    public function deleteApi($id)
    {
        $cita = Cita::find($id);
        $this->authorize('delete', $cita);
        Cita::destroy($id);

        return response()->json([
            'message' => 'Cita eliminada correctamente'
        ]);
    }
}
