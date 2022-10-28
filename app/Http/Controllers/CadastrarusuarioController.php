<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cadastrousuario;
use App\Http\Requests\cadastroRequest;

class CadastrarusuarioController extends Controller
{
   public function index(){
    return view('cadastros.index');
   }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    cadastrousuario::create($request->all());
    return redirect()->route('home');
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param cadastrousuario $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        
        cadastrousuario::destroy($request->usuario);
       
        return redirect()->route('users.index');
    }
}
