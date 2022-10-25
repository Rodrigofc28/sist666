<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cadastrousuario;
use App\Http\Requests\CadastroRequest;

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
}
