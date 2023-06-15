<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Formulario extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'imagem_base64', 'upload_image', 'mensagens','perito_id'
         
    ];
    

    protected $dates = ['deleted_at'];

    public function secao()
    {
        return $this->belongsTo(Secao::class);
    }
    

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function perito()
    {
        return $this->belongsTo(User::class, 'perito_id', 'id');
    }

    
    public function solicitante()
    {
        return $this->belongsTo(OrgaoSolicitante::class);
    }

    
    public function imagens()
    {
        return $this->hasMany(ImagemEmbalagem::class,'laudo_id', 'id');
    }

    
    

    // this is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($laudo) { // before delete() method call this

            $laudo->armas()->delete();
            $laudo->municoes()->delete();
            $laudo->componentes()->delete();
        });
    }

    /**
     * Local Scope utilizado para filtrar somente os laudos de um perito
     *
     * @param $query
     * @param $perito
     * @return mixed
     */
    

    public static function config_laudo_info($request)
    {
        
        $data_recebimento = formatar_data($request->input('data_recebimento'));
        $dadosCodImg1 = base64_encode($request->imagem_base64);
        $dadosCodImg2 = base64_encode($request->imagemFinal_base64);
        $laudo = $request->except(['data_recebimento','imagem_base64','imagemFinal_base64']);
        $laudo_info = array_merge($laudo, ['data_recebimento'=>$data_recebimento,'imagem_base64'=>$dadosCodImg1,'imagemFinal_base64'=>$dadosCodImg2]);
        return $laudo_info;
    }

    /* Relatórios */

    public function scopeCustomReport($query, $filtros)
    {
        $secoes = isset($filtros['secoes_ids']) ? $filtros['secoes_ids'] : [null];
        $peritos = isset($filtros['peritos_ids']) ? $filtros['peritos_ids'] : [null];
        $data_inicial = formatar_data($filtros['data_inicial']);
        $data_final = formatar_data($filtros['data_final']);

        $query->whereBetween(DB::raw('date(created_at)'), [$data_inicial, $data_final]);

        if(isset($filtros['secoes_ids'], $filtros['peritos_ids'])){
            $query->whereIn('perito_id', $peritos)
                ->whereIn('secao_id', $secoes);
        }
        if(isset($filtros['secoes_ids'])) {
            $query->whereIn('secao_id', $secoes);
        }
        if(isset($filtros['peritos_ids'])) {
            $query->whereIn('perito_id', $peritos);
        }
        return $query->get();
    }

    public static function total_laudos_gerados()
    {
        $total = Formulario::all()->count();
        return $total;
    }

    

    

    
}
