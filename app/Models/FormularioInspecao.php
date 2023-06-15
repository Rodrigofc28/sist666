<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormularioInspecao extends Model
{
    use SoftDeletes;

    protected $table = 'formularioinspecoes';

    protected $fillable = [
        "cidade_id",
        "data",
        "hora",
        "placa",
        "condutor",
        "veiculo",
        "oleoobs",
        "aguaobs",
        "limpadorobs",
        "palhetaobs",
        "faroisobs",
        "observacao",
        "imagem_base64Lat",
        "imagem_base64LatEsq",
        "imagem_base64Frent",
        "perito_id",
        "oleo",
        "agua",
        "agualimpador",
        "palheta",
        "triangulo",
        "estepe",
        "chaveroda", 
        "macaco",
        "imagem_base64Tran",
        "estobs",
        "triobs",
        "chaobs",
        "macoobs",
        "rg",
        "km"  
    ];

    protected $dates = ['deleted_at'];
    

    
}
