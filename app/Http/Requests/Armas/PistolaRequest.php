<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Requests\Armas;

use Illuminate\Foundation\Http\FormRequest;

class PistolaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'marca_id' => 'required|integer',
            'calibre_id' => 'required|integer',
            'origem_id' => 'required|integer',
            'laudo_id' => 'required|integer',
            'modelo' => 'nullable',
            'tipo_serie' => 'required|between:5,40',
            'num_serie' => 'nullable',
            'quantidade_raias' => 'required|integer|min:0|max:30',
            'comprimento_cano' => 'required|between:5,10',
            'comprimento_total' => 'required|between:5,10',
            'altura' => 'required|between:5,10',
            'estado_geral' => 'required|between:2,15',
            'funcionamento' => 'required|between:5,25',
            'sentido_raias' => 'required|between:5,30',
            'cabo' => 'required|between:4,30',
            'tipo_acabamento' => 'required|between:5,40',
            'tipo_arma' => 'required|between:5,30',
            'capacidade_carregador' => 'required',
            'diametro_cano'=>'required',
            'num_lacre' => 'required',
            
            'sistema_funcionamento'=>'required',
            'sistema_carregamento'=>'required',
            'num_canos'=>'required',
            'tipo_carregador'=>'nullable', 
            'sistema_percussao'=>'required',   
            'sistema_disparo'=>'required',
            'sistema_inflamacao'=>'required',
            'salva_cadastro'=>'nullable'
        ];
    }
}
