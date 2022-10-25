<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Models\Armas;

use Illuminate\Database\Eloquent\Model;


class Metralhadora extends Model
{
    public static function text($arma)
    {
        

        $resultado = Shared::funcionamento($arma->funcionamento);
        $fim = "Observação: A metralhadora acima descrita devidamente identificada com o lacre nº $arma->num_lacre, permanecerá sob custódia da POLÍCIA CIENTÍFICA DO PARANÁ.";
        $laudo = array_merge($text, ['resultado' => $resultado, 'fim' => $fim]);

        return $laudo;
    }

    

    private static function metralhadora($arma)
    {
        $calibre = Shared::calibre($arma->calibre->nome, $arma->calibre_real);
        $tipo_acabamento = Shared::acabamento($arma->tipo_acabamento);
        $numeracao_montagem = Shared::numeracao_montagem($arma->numeracao_montagem);
        $modelo = Shared::modelo($arma->modelo);
        $bandoleira = Shared::bandoleira($arma->bandoleira);
        $serie = Shared::serie($arma->tipo_serie, $arma->num_serie);
        $marca = Shared::marca($arma->marca->nome);
        $chave_abertura = Shared::chaveAbertura($arma->chave_abertura);
        $sistema_funcionamento = Shared::sistemaFuncionamento($arma->sistema_funcionamento, $arma->tipo_carregador);
        $origem = mb_strtolower($arma->origem->fabricacao);
        $inicio = "$arma->tipo_arma Marca $marca calibre $calibre: ";
        $corpo = "Trata-se de uma " . mb_strtolower($arma->tipo_arma) . " $sistema_funcionamento, marca $marca,$modelo fabricação $origem, $calibre, $serie$numeracao_montagem, com sistema de carregamento tipo $arma->sistema_carregamento, sistema de percussão $arma->sistema_percussao, $arma->num_canos cano e sistema de engatilhamento $arma->sistema_engatilhamento. $tipo_acabamento, apresenta coronha e fuste em $arma->coronha_fuste,$bandoleira chave de abertura localizada $chave_abertura e encontra-se em $arma->estado_geral estado de conservação. Suas medidas são: comprimento total: " . str_replace(".", ",", $arma->comprimento_total) . "m e o cano mede " . str_replace(".", ",", $arma->comprimento_cano) . "m.";
        return ['inicio' => $inicio, 'corpo' => $corpo];
    }
}
