<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Controllers\Perito;

use App\Http\Controllers\Controller;
use App\Http\Requests\LaudoRequest;
use App\Models\Cidade;

use App\Models\Gerador\Gerar;
use App\Models\Formulario;
use App\Models\FormularioInspecao;
use App\Models\OrgaoSolicitante;
use App\Models\Secao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class LaudosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $user = Auth::id();
        $laudos = Laudo::findMyReps($user);
        return view('perito.laudo.index', compact('laudos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $secoes = Secao::all();
        $cidades = Cidade::all();
      

        return view('perito.laudo.create',
            compact('secoes', 'cidades'));
    }

    
    public function store(Request $request)
    {  
        $usuario=Auth::user()->nome;
        $mensagens=$request->only(['mensagens','perito_id']);
        $converte=md5($request->upload_image.strtotime("now")).'.'.'mp4';
        $salvarBanco=['upload_image'=>$converte]; 
        $banco_de_dados=array_merge($salvarBanco,$mensagens);
        Formulario::create($banco_de_dados);    
            
        if (!is_dir(storage_path('app/public/imagensUsuarios'))) { // verifica se existe a pasta upload
            mkdir(storage_path('app/public/imagensUsuarios'), 0755, true);
           
            $request->upload_image->move(storage_path('app/public/imagensUsuarios'),$converte);
        }else{
            $request->upload_image->move(storage_path('app/public/imagensUsuarios'),$converte);
        };
            
        
        return redirect()->route('dashboard');
    }

    
    public function show(Formulario $laudo)
    {
        $cidades = Cidade::all();
        $secoes = Secao::all();
        $diretores = Diretor::allOrdered();
        $solicitantes = OrgaoSolicitante::fromCity($laudo->cidade_id);
        $armas = $laudo->armas;
        $municoes = $laudo->municoes;
        $componentes = $laudo->componentes;
        
        return view('perito.laudo.show',
            compact('laudo', 'cidades', 'solicitantes',
                'diretores', 'secoes', 'armas', 'municoes', 'componentes'));
    }

    
    public function update(Request $request, $laudo)
    {
        
        $updated_laudo = Formulario::config_laudo_info($request);
        Formulario::find($laudo->id)->fill($updated_laudo)->save();
        $laudo_id = $laudo->id;
        return redirect()->route('laudos.show', compact('laudo_id'))
            ->with('success', __('flash.update_m', ['model' => 'Laudo']));
    }

    
    public function destroy($laudo)
    {
        Formulario::destroy($laudo->id);
        return response()->json(['success' => 'done']);
    }

    public function materiais($laudo)
    {
        return view('perito.materiais', compact('laudo'));
    }

    public function generate_docx($laudo)
    {
      
       $id=Auth::id(); // pega o id do usuario
       
        
       $today = Carbon::today()->toDateString(); //Carbon é uma classe que manipula datas

        $users = DB::table('formularios')
            ->where('perito_id', $id)
            ->whereDate('created_at', $today)
            ->where('secao_id',$laudo)
            ->get();
            
        
            $phpWord = new Gerar();
          
            $phpWord = $phpWord->create_docx($users,$laudo);

            return $phpWord;
        
    }

    public function search($rep)
    {
        $rep = str_replace('-', '/', $rep);
        $laudo = Formulario::where([['rep', $rep], ['perito_id', Auth::id()]])->first();
        if(empty($laudo)){
            return response()->json(['fail' => 'true',
            'message' => 'Nenhum laudo encontrado em este número (' . $rep . ')']);
        } else {
            $laudo_id = $laudo->id;
            return response()->json(['url' => route('laudos.show', $laudo)]);
        }
    }
}
