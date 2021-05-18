<?php

namespace App\Http\Controllers;

use App\Mail\CuentaMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class EmprendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['emprendedores'] = DB::table('users')->where('rol', 'emprendedor')->paginate(20);
        return view('emprendedor.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('emprendedor.create');
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
        $datosEmprendedor = request()->except('_token');
        $datosEmprendedor['password'] = $pass;
        $datosEmprendedor['rol'] = 'emprendedor';
        if ($request->hasFile('foto')) {
            $datosEmprendedor['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        User::insert($datosEmprendedor);
        $datosEmprendedor['contaseña'] = $random;
        $correo = new CuentaMailable($random, $datosEmprendedor['email'], 'emprendedor');
        Mail::to($datosEmprendedor['email'])->send($correo);
        //$id = DB::getPdo()->lastInsertId();;


        //return response()->json($id);
        if (Auth::user()->rol == 'administrador') {
            return redirect('usuario')->with('mensaje', 'Emprendedor creado con exito');
        } else {
            return redirect('emprendedor')->with('mensaje', 'Emprendedor creado con exito');
        }

        //return redirect('emprendedor')->with('mensaje', 'Emprendedor creado con exito');
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
        $emprendedor = User::findOrFail($id);
        return view('emprendedor.edit', compact('emprendedor'));
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
        $url = url()->previous();
        $datosEmprendedor = request()->except(['_token', '_method']);
        if ($request->hasFile('foto')) {
            $emprendedor = User::findOrFail($id);
            Storage::delete('public/' . $emprendedor->foto);
            $datosEmprendedor['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        User::where('id', '=', $id)->update($datosEmprendedor);
        //return redirect('emprendedor');
        //return response()->json($url);
        if (Str::contains($url, 'usuario')) {
            $result = 'usuario';
        } else {
            $result = 'emprendedor';
        }
        return redirect($result)->with('mensaje', 'Emprendedor editado con exito');
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
        $emprendedor = User::findOrFail($id);
        if (Storage::delete('public/' . $emprendedor->foto)) {
            User::destroy($id);
        }
        User::destroy($id);
        //return redirect('emprendedor')->with('mensaje', 'emprendedor eliminado con exito');
        return redirect()->back()->with('mensaje', $emprendedor->rol . ' eliminado con exito');
    }
}
