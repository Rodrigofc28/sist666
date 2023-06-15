<?php

namespace App\Http\Controllers\Perito;

use Illuminate\Support\Facades\Auth;
use App\Models\Secao;
use App\Models\Cidade;
use App\Models\FormularioInspecao;
use App\Models\Gerador\Gerar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormularioController extends Controller{


    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        $secoes = Secao::all();
        $cidades = Cidade::all();
        

        return view('perito.laudo.formulario',
            compact('secoes', 'cidades'));
    }
    public function store(Request $request)
    {
        
        FormularioInspecao::create($request->all());
        $msg="sucesso";
        $phpWord = new Gerar();
        $phpWord = $phpWord->create_docx_formulario($request);
        return $phpWord;
    }
    public function generate_docx()
    {
    //
    }
}