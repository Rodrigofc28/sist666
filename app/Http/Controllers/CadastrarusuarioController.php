<?php

namespace App\Http\Controllers;

use App\Models\Secao;
use Illuminate\Http\Request;
use App\Models\cadastrousuario;
use App\Http\Requests\cadastroRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class CadastrarusuarioController extends Controller
{
   public function index(){
    $secoes = Secao::all();
        
    return view('cadastros.index',compact('secoes'));
   }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(cadastroRequest $request)
    {
        
    $senhaCodificada= Hash::make($request['password']);    
    $usuarioNovo=$request->except('password');
    $usuarioNovoCadastro= array_merge($usuarioNovo,['password'=>$senhaCodificada]);
    User::create($usuarioNovoCadastro);
    
    //cadastrousuario::create($request->all());
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
