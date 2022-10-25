<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255',
            'nome' => 'required|min:6',
            'secao_id' => 'required',
            'cargo_id' => 'required',
            'password' => 'required|string|min:6',
            'timestamps'=>'date'
            
        ];
    
    }
}