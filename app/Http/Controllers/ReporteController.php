<?php

namespace App\Http\Controllers;

use App\Mail\ReporteMail;
use App\Models\Hotel;
use App\Models\Pasajero;
use App\Models\Reporte;
use App\Models\Trenes;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportes = Reporte::with('pasajeros')->get();
        return view('reportes.index', compact('reportes'));
    }

    public function enviarCorreo($id)
    {
        $reporte = Reporte::findOrFail($id);
        $correo = new ReporteMail($reporte);
        Mail::to($reporte->email)->send($correo);
        return redirect()->back()->with('success', 'Email enviado com sucesso para' . $reporte->email);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reportes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tour' => 'required',
            'nombre' => 'required',
            'email' => 'required|email',
            'numero' => 'required',
            'llegada' => 'nullable',
            'salida' => 'nullable',
            'fechaInicio' => 'nullable|date',
            'numPaxs' => 'nullable|integer',
            'precio' => 'nullable|numeric',
            'adelanto' => 'nullable|numeric',
            'detalles' => 'required',

            'pasajeros' => 'nullable|array',
            'pasajeros.*.nombre' => 'required',
            'pasajeros.*.fechaNacimiento' => 'required',
            'pasajeros.*.numeroPasaporte' => 'required',
            'pasajeros.*.nacionalidad' => 'required',
            'pasajeros.*.alimentacion' => 'required',
            'pasajeros.*.es_estudiante' => 'nullable|boolean',

            'trenes' => 'nullable|array',
            'trenes.*.ruta' => 'required',
            'trenes.*.compania' => 'required',
            'trenes.*.servicio' => 'required',
            'trenes.*.fecha' => 'required|date',
            'trenes.*.hora' => 'required',

            'hoteles' => 'nullable|array',
            'hoteles.*.hotel' => 'required',
            'hoteles.*.lugar' => 'required',
            'hoteles.*.acomodacion' => 'required',
            'hoteles.*.fechaIngreso' => 'required|date',
            'hoteles.*.fechaSalida' => 'required|date',
        ], [
            'detalles.required' => 'Por favor, ingrese los detalles',
            // Otros mensajes de validación para los demás campos...
        ]);

        $reporteData = $request->only([
            'tour',
            'nombre',
            'email',
            'numero',
            'llegada',
            'salida',
            'fechaInicio',
            'numPaxs',
            'precio',
            'adelanto',
            'detalles'
        ]);

        $reporteData['llegada'] = $request->input('llegada', null); // Asignar null si no se proporciona un valor
        
        $reporte = Reporte::create($reporteData);

        if ($request->has('pasajeros')) {
            $pasajerosData = array_map(function ($datosPasajero) {
                return [
                    'nombre' => htmlspecialchars($datosPasajero['nombre']),
                    'fechaNacimiento' => htmlspecialchars($datosPasajero['fechaNacimiento']),
                    'numeroPasaporte' => htmlspecialchars($datosPasajero['numeroPasaporte']),
                    'nacionalidad' => htmlspecialchars($datosPasajero['nacionalidad']),
                    'alimentacion' => htmlspecialchars($datosPasajero['alimentacion']),
                    'es_estudiante' => $datosPasajero['es_estudiante'] === '1' ? true : false
                ];
            }, $request->pasajeros);

            $reporte->pasajeros()->createMany($pasajerosData);
        }

        if ($request->has('trenes') && is_array($request->trenes)) {
            $trenesData = array_map(function ($datosTren) {
                return [
                    'ruta' => htmlspecialchars($datosTren['ruta']),
                    'compania' => htmlspecialchars($datosTren['compania']),
                    'servicio' => htmlspecialchars($datosTren['servicio']),
                    'fecha' => $datosTren['fecha'],
                    'hora' => htmlspecialchars($datosTren['hora'])
                ];
            }, $request->trenes);

            $reporte->trenes()->createMany($trenesData);
        }

        if ($request->has('hoteles') && is_array($request->hoteles)) {
            $hotelesData = array_map(function ($datosHotel) {
                return [
                    'hotel' => htmlspecialchars($datosHotel['hotel']),
                    'lugar' => htmlspecialchars($datosHotel['lugar']),
                    'acomodacion' => htmlspecialchars($datosHotel['acomodacion']),
                    'fechaIngreso' => $datosHotel['fechaIngreso'],
                    'fechaSalida' => $datosHotel['fechaSalida']
                ];
            }, $request->hoteles);

            $reporte->hoteles()->createMany($hotelesData);
        }

        return redirect()->route('reportes.index')->with('success', 'Reporte creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reporte = Reporte::findOrFail($id);
        $pasajeros = $reporte->pasajeros;

        return view('reportes.show', compact('reporte', 'pasajeros'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Reporte $reporte)
    {
        return view('reportes.edit', compact('reporte'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'tour' => 'required',
            'nombre' => 'required',
            'email' => 'required|email',
            'numero' => 'required',
            'llegada' => 'nullable',
            'salida' => 'nullable',
            'fechaInicio' => 'nullable|date',
            'numPaxs' => 'nullable|integer',
            'precio' => 'nullable|numeric',
            'adelanto' => 'nullable|numeric',
            'detalles' => 'required',
            'pasajeros' => 'nullable|array',
            'pasajeros.*.nombre' => 'nullable',
            'pasajeros.*.fechaNacimiento' => 'nullable',
            'pasajeros.*.numeroPasaporte' => 'nullable',
            'pasajeros.*.nacionalidad' => 'nullable',
            'pasajeros.*.alimentacion' => 'nullable',
            'pasajeros.*.es_estudiante' => 'nullable|boolean',
            'trenes' => 'nullable|array',
            'trenes.*.ruta' => 'required',
            'trenes.*.compania' => 'required',
            'trenes.*.servicio' => 'required',
            'trenes.*.fecha' => 'required|date',
            'trenes.*.hora' => 'required',
            'hoteles' => 'nullable|array',
            'hoteles.*.hotel' => 'required',
            'hoteles.*.lugar' => 'required',
            'hoteles.*.acomodacion' => 'required',
            'hoteles.*.fechaIngreso' => 'required',
            'hoteles.*.fechaSalida' => 'required',
        ]);

        $reporte = Reporte::findOrFail($id);
        $reporte->tour = $request->input('tour');
        $reporte->nombre = $request->input('nombre');
        $reporte->email = $request->input('email');
        $reporte->numero = $request->input('numero');
        $reporte->llegada = $request->input('llegada');
        $reporte->salida = $request->input('salida');
        $reporte->fechaInicio = $request->input('fechaInicio');
        $reporte->numPaxs = $request->input('numPaxs');
        $reporte->precio = $request->input('precio');
        $reporte->adelanto = $request->input('adelanto');
        $reporte->detalles = $request->input('detalles');
        $reporte->save();

        $reporte->pasajeros()->delete();
        if ($request->has('pasajeros')) {
            foreach ($request->pasajeros as $datosPasajero) {
                $pasajero = new Pasajero();
                $pasajero->nombre = htmlspecialchars($datosPasajero['nombre']);
                $pasajero->fechaNacimiento = htmlspecialchars($datosPasajero['fechaNacimiento']);
                $pasajero->numeroPasaporte = htmlspecialchars($datosPasajero['numeroPasaporte']);
                $pasajero->nacionalidad = htmlspecialchars($datosPasajero['nacionalidad']);
                $pasajero->alimentacion = htmlspecialchars($datosPasajero['alimentacion']);
                $pasajero->es_estudiante = $datosPasajero['es_estudiante'] === '1' ? true : false;
                $reporte->pasajeros()->save($pasajero);
            }
        }

        // Eliminar tours existentes
        $reporte->trenes()->delete();

        if ($request->has('trenes') && is_array($request->trenes)) {
            foreach ($request->trenes as $datosTren) {
                $tren = new Trenes();
                $tren->ruta = htmlspecialchars($datosTren['ruta']);
                $tren->compania = htmlspecialchars($datosTren['compania']);
                $tren->servicio = htmlspecialchars($datosTren['servicio']);
                $tren->fecha = $datosTren['fecha'];
                $tren->hora = htmlspecialchars($datosTren['hora']);
                $reporte->trenes()->save($tren);
            }
        }

        // Eliminar hoteles existentes
        $reporte->hoteles()->delete();

        if ($request->has('hoteles') && is_array($request->hoteles)) {
            foreach ($request->hoteles as $datosHotel) {
                $hotel = new Hotel();
                $hotel->hotel = htmlspecialchars($datosHotel['hotel']);
                $hotel->lugar = htmlspecialchars($datosHotel['lugar']);
                $hotel->acomodacion = htmlspecialchars($datosHotel['acomodacion']);
                $hotel->fechaIngreso = $datosHotel['fechaIngreso'];
                $hotel->fechaSalida = $datosHotel['fechaSalida'];
                $reporte->hoteles()->save($hotel);
            }
        }


        return redirect()->route('reportes.index')->with('success', 'Reporte actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reporte $reporte)
    {
        $reporte->delete();
        return redirect()->route('reportes.index')->with('success', 'Reporte eliminado exitosamente');
    }

    public function gridData()
    {
        $reportes = Reporte::all(); // Cambia esto según tu modelo y datos

        $data = $reportes->map(function ($reporte) {
            $nombre = $reporte->nombre;
            $fecha = $reporte->created_at->format('Y-m-d');

            $iniciales = '';
            $palabras = explode(' ', $nombre);

            foreach ($palabras as $palabra) {
                $iniciales .= strtoupper(substr($palabra, 0, 1));
            }

            $variableConcatenada = $iniciales . date('Ymd', strtotime($fecha)) . 'MIT';


            return [
                'Id' => $reporte->id,
                'Cod' => $variableConcatenada,
                'Paquete' => $reporte->tour,
                'Nombre_pax' => $reporte->nombre,
                'Email' => $reporte->email,

            ];
        });

        return response()->json($data);
    }
}