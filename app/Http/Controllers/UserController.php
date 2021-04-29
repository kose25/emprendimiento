<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\FuncionarioEntidad;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //$this->middleware('role:administrador');
    }
    
    public function index()
    {
        //

        $users = User::all();

        return view('user.index', compact('users'));
        //return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $user = User::findOrFail($id);
        return view('user.profiletest', compact('user'));
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
        $user = User::findOrFail($id);

        switch ($user->rol) {
            case 'emprendedor':
                $emprendedor = $user;
                return view('emprendedor.edit', compact('emprendedor'));
                break;

            case 'entidad':
                $entidad = $user;
                return view('entidad.edit', compact('entidad'));
                break;
            case 'funcionario':
                $funcionario = $user;
                $entidades = DB::table('users')->where('rol', 'entidad')->get();
                $entidadxd = FuncionarioEntidad::select('entidad')->where('funcionario', '=', $id)->value('entidad');
                return view('funcionario.edit', compact('funcionario', 'entidades', 'entidadxd'));
                break;
        }
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
    }

    public function profile($rol)
    {

        //$user = Auth::user();
        $view = '';

        switch ($rol) {
            case 'administrador':
                $view = 'user.profile';
                $datos['administrador'] = Auth::user();
                break;

            case 'funcionario':
                $view = 'funcionario.edit';
                $datos['funcionario'] = Auth::user();
                break;

            case 'entidad':
                $view = 'entidad.edit';
                $datos['entidad'] = Auth::user();
                break;

            case 'emprendedor':
                $view = 'emprendedor.edit';
                $datos['emprendedor'] = Auth::user();
                break;
        }

        //$posts = Post::where('usuario', Auth::user()->id)->orderByDesc('id')->get();

        return view('user.profile');
    }
}
