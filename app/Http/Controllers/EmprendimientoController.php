<?php

namespace App\Http\Controllers;

use App\Models\Emprendimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EmprendimientoEntidad;
use Illuminate\Support\Facades\Storage;

class EmprendimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['emprendimientos'] = Emprendimiento::paginate(10);
        $datosxd['emprendimientos'] = Emprendimiento::select('e.id', 'e.nombre', 'e.descripcion', 'e.email', 'e.nit', 'e.ciudad', 'e.foto', 'lider.name as lider', 'entidad.name as entidad')
            ->from('emprendimientos as e')
            ->join('users as lider', function ($join) {
                $join->on('lider.id', '=', 'e.lider');
            })
            ->join('users as entidad', function ($join) {
                $join->on('entidad.id', '=', 'e.entidad');
            })
            ->paginate(10);
        return view('emprendimiento.index', $datosxd);
        //return response()->json($datosxd);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $datos['emprendedores'] = DB::table('users')->where('rol', 'emprendedor')->get();
        $datos1['entidades'] = DB::table('users')->where('rol', 'entidad')->get();

        return view('emprendimiento.create', $datos, $datos1);
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
        $datosEmprendimiento = request()->except('_token');
        //solicita los datos del emprendedor y entidad del emprendimiento
        //$relacion = request()->only('emprendedor', 'entidad');
        //inserta el emprendimiento en la tabla emprendimiento
        //Emprendimiento::insert($datosEmprendimiento);
        //inserta la relacion del emprendor, entidad y emprendimiento en la tabla Emprendimiento_Entidad
        //EmprendimientoEntidad::insert($relacion);

        if ($request->hasFile('foto')) {
            $datosEmprendimiento['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        Emprendimiento::insert($datosEmprendimiento);
        return redirect('emprendimiento')->with('mensaje', 'Emprendimiento creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emprendimiento  $emprendimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Emprendimiento $emprendimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emprendimiento  $emprendimiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $emprendimiento = Emprendimiento::findOrFail($id);
        $emprendedores = DB::table('users')->where('rol', 'emprendedor')->get();
        $entidades = DB::table('users')->where('rol', 'entidad')->get();
        return view('emprendimiento.edit', compact('emprendimiento', 'emprendedores', 'entidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emprendimiento  $emprendimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosEmprendimiento = request()->except(['_token', '_method']);
        if ($request->hasFile('foto')) {
            $emprendimiento = Emprendimiento::findOrFail($id);
            Storage::delete('public/' . $emprendimiento->foto);
            $datosEmprendimiento['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        Emprendimiento::where('id', '=', $id)->update($datosEmprendimiento);
        return redirect('emprendimiento');
        //return response()->json($datosEmprendimiento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emprendimiento  $emprendimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $emprendimiento = Emprendimiento::findOrFail($id);
        if (Storage::delete('public/' . $emprendimiento->foto)) {
            Emprendimiento::destroy($id);
        }
        Emprendimiento::destroy($id);
        return redirect('emprendimiento')->with('mensaje', 'Emprendimiento eliminado con exito');
    }
}
