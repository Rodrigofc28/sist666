<?php
// arquivo carabina
namespace App\Http\Controllers\Perito\Armas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Armas\MetralhadoraRequest;
use App\Models\Arma;
use App\Models\Calibre;
use App\Models\Marca;
use App\Models\Origem;

class MetralhadorasController extends Controller
{
    
        public function __construct()
        {
            $this->middleware('auth');
        }
         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($laudo)
    {
        $marcas = Marca::categoria('armas'); // classes do models marca, origem, calibre
        $origens = Origem::all();
        $calibres = Calibre::whereArma('Metralhadora'); //mudar colocar carabina
        return view('perito.laudo.materiais.armas.metralhadora.create',
            compact('laudo', 'marcas', 'origens', 'calibres'));
    }
        public function show(Arma $metralhadora)
        {
    //        $marcas = Marca::marcasWithTrashed('armas', $espingarda->marca);
    //        $origens = Origem::origensWithTrashed($espingarda->origem);
    //        $calibres = Calibre::calibresWithTrashed('revólver', $espingarda->calibre);
            return view('perito.laudo.materiais.armas.metralhadora.show',
                compact('arma'));
        }

  /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laudo $laudo
     * @param  \App\Models\Arma $espingarda
     * @return \Illuminate\Http\Response
     */
    public function edit($laudo, Arma $metralhadora)
    {
        $marcas = Marca::marcasWithTrashed('armas', $metralhadora->marca);
        $origens = Origem::origensWithTrashed($metralhadora->origem);
        $calibres = Calibre::calibresWithTrashed('Metralhadora', $metralhadora->calibre);
        $imagens = $metralhadora->imagens;
        return view('perito.laudo.materiais.armas.metralhadora.edit',
            compact('metralhadora', 'laudo', 'marcas', 'origens', 'calibres', 'imagens'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Arma $revolver
     * @return \Illuminate\Http\Response
     */
    public function update(MetralhadoraRequest $request, $laudo_id, Arma $metralhadora)
    {
        $updated_arma = $request->all();
        Arma::find($metralhadora->id)->fill($updated_arma)->save();
        return redirect()->route('laudos.show', ['id' => $laudo_id])
            ->with('success', __('flash.update_f', ['model' => 'Metralhadora']));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MetralhadoraRequest $request)
    {
        Arma::create($request->all());
        return redirect()->route('laudos.show',
            ['laudo_id' => $request->input('laudo_id')])
            ->with('success', __('flash.create_f', ['model' => 'Metralhadora']));
    }

}