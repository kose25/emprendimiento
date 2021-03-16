<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CuentaMailable;
use App\Models\FuncionarioEntidad;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['funcionarios'] = DB::table('users')->where('rol', 'funcionario')->paginate(20);
        $datosxd['funcionarios'] = User::select('u.id as id_funcionario', 'u.name', 'u.descripcion', 'u.email', 'u.nit', 'u.foto', 'u.celular', 'u.direccion', 'funcionario.id', 'entidadxd.name as entidad', 'entidadxd.id as id_entidad')
            ->from('users as u')
            ->join('funcionario_entidads as funcionario', function ($join) {
                $join->on('u.id', '=', 'funcionario.funcionario');
            })
            ->join('users as entidadxd', function ($join) {
                $join->on('funcionario.entidad', '=', 'entidadxd.id');
            })
            ->paginate(10);
        return view('funcionario.index', $datosxd);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $datos1['entidades'] = DB::table('users')->where('rol', 'entidad')->get();
        return view('funcionario.create', $datos1);
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
        $datosFuncionario = request()->except('_token', 'entidad');
        $datosFuncionario['password'] = $pass;
        $datosFuncionario['rol'] = 'funcionario';


        if ($request->hasFile('foto')) {
            $datosFuncionario['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        //FuncionarioEntidadDB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle'])

        User::insert($datosFuncionario);

        $id = DB::getPdo()->lastInsertId();
        $funent['funcionario'] = $id;
        $funent['entidad'] = $request['entidad'];

        FuncionarioEntidad::insert($funent);
        $datosFuncionario['contaseña'] = $random;
        $correo = new CuentaMailable($random, $datosFuncionario['email'], 'funcionario');
        Mail::to($datosFuncionario['email'])->send($correo);
        return redirect('funcionario')->with('mensaje', 'Funcionario creado con exito');
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
        $funcionario = User::findOrFail($id);
        $entidades = DB::table('users')->where('rol', 'entidad')->get();
        $entidadxd = FuncionarioEntidad::select('entidad')->where('funcionario', '=', $id)->value('entidad');
        return view('funcionario.edit', compact('funcionario', 'entidades', 'entidadxd'));

        //return response()->json($entidadxd);
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
        $datosFuncionario = request()->except(['_token', '_method', 'entidad']);
        //$relation=[];
        $relation['funcionario'] = $id;
        $relation['entidad'] = request()->input('entidad');

        $relationid = FuncionarioEntidad::select('id')
            ->where('funcionario', '=', $id)
            //->where('entidad', '=', $relation['entidad'])
            ->value('id');

        if ($request->hasFile('foto')) {
            $funcionario = User::findOrFail($id);
            Storage::delete('public/' . $funcionario->foto);
            $datosFuncionario['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        FuncionarioEntidad::where('id', '=', $relationid)->update($relation);

        User::where('id', '=', $id)->update($datosFuncionario);

        //return response()->json($relationid);
        return redirect('funcionario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $relation = FuncionarioEntidad::findOrFail($request['entidad']);
        $funcionario = User::findOrFail($id);
        if (Storage::delete('public/' . $funcionario->foto)) {
            FuncionarioEntidad::destroy($relation['id']);
            User::destroy($id);
        }
        //User::destroy($id);
        return redirect('funcionario')->with('mensaje', 'funcionario eliminado con exito');
        //return response()->json($relation['id']);

    }
}
