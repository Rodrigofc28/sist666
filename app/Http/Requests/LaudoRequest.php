<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaudoRequest extends FormRequest
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
           
            'rep' => 'required',
            
            'data_solicitacao' => 'required|date_format:"d/m/Y"|before_or_equal:data_designacao',
           
            'secao_id' => 'required',
            'cidade_id' => 'required',
            
            'perito_id' => 'required',
            'diretor_id' => 'nullable',
            'indiciado' => 'nullable|min:6|max:80',
            
            
            
            'nomeIncluir'=>'nullable',
           
        ];
    }
}
