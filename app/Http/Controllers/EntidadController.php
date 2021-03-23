<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\CuentaMailable;
use Illuminate\Support\Facades\Auth;

class EntidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['entidades'] = DB::table('users')->where('rol', 'entidad')->paginate(20);
        return view('entidad.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('entidad.create');
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
        $random = Str::random(8);
        $pass = Hash::make($random);
        $datosEntidad = request()->except('_token');
        $datosEntidad['password'] = $pass;
        $datosEntidad['rol'] = 'entidad';
        if ($request->hasFile('foto')) {
            $datosEntidad['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        User::insert($datosEntidad);
        $datosEntidad['contaseña'] = $random;
        $correo = new CuentaMailable($random, $datosEntidad['email'], 'entidad');
        Mail::to($datosEntidad['email'])->send($correo);


        //return response()->json($datosEntidad);
        if (Auth::user()->rol == 'administrador') {
            return redirect('usuario')->with('mensaje', 'Entidad creada con exito');
        } else {
            return redirect('entidad')->with('mensaje', 'Entidad creada con exito');
        }
        //return redirect('entidad')->with('mensaje', 'Entidad creada con exito');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $entidad = User::findOrFail($id);
        return view('entidad.edit', compact('entidad'));
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
        $datosEntidad = request()->except(['_token', '_method']);
        if ($request->hasFile('foto')) {
            $entidad = User::findOrFail($id);
            Storage::delete('public/' . $entidad->foto);
            $datosEntidad['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        User::where('id', '=', $id)->update($datosEntidad);
        $url = url()->previous();
        if (Str::contains($url, 'usuario')) {
            $result = 'usuario';
        } else {
            $result = 'entidad';
        }
        return redirect($result)->with('mensaje', 'Entidad editada con exito');
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
        $entidad = User::findOrFail($id);
        if (Storage::delete('public/' . $entidad->foto)) {
            User::destroy($id);
        }
        User::destroy($id);
        //return redirect('entidad')->with('mensaje', 'entidad eliminado con exito');
        return redirect()->back()->with('mensaje', 'Entidad eliminada con exito');
    }
}
