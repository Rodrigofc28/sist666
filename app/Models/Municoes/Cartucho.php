<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Models\Municoes;

use Illuminate\Database\Eloquent\Model;


class Cartucho extends Model
{
    private static $quantidade, $marca, $calibre;

    public static function text($municao)
    {
        self::$quantidade = $municao->quantidade;
        self::$marca = $municao->marca->nome;
        self::$calibre = $municao->calibre->nome;

        if ($municao->municao_de == "arma longa") {
            $text = self::cartucho_arma_longa($municao);
        } else {
            $text = self::cartucho_arma_curta($municao);
        }

        $fim = "";
        $laudo = array_merge($text, ['fim' => $fim]);

        return $laudo;
    }

    private static function cartucho_arma_curta($municao)
    {   
        
        switch (self::$quantidade) {
            case self::$quantidade > 1 && $municao->nao_deflagrado == false:
                return self::cartuchos_arma_curta_deflagrados($municao);
                break;
            case self::$quantidade == 1 && $municao->nao_deflagrado == false:
                return self::cartucho_arma_curta_deflagrado($municao);
                break;
            case self::$quantidade > 1 && $municao->nao_deflagrado == true:
                return self::cartuchos_arma_curta_nao_deflagrados($municao);
                break;
            case self::$quantidade == 1 && $municao->nao_deflagrado == true:
                return self::cartucho_arma_curta_nao_deflagrado($municao);
                break;
        }
    }

    private static function cartucho_arma_longa($municao)
    {
        
        switch (self::$quantidade) {
            case self::$quantidade > 1 && $municao->nao_deflagrado == false:
                return self::cartuchos_arma_longa_deflagrados($municao);
                break;
            case self::$quantidade == 1 && $municao->nao_deflagrado == false:
                return self::cartucho_arma_longa_deflagrado($municao);
                break;
            case self::$quantidade > 1 && $municao->nao_deflagrado == true:
                return self::cartuchos_arma_longa_nao_deflagrados($municao);
                break;
            case self::$quantidade == 1 && $municao->nao_deflagrado == true:
                return self::cartucho_arma_longa_nao_deflagrado($municao);
                break;
        }
    }

    /*---- Cartucho(s) de Arma Curta ------*/

    private static function cartucho_arma_curta_deflagrado($municao)
    {
        $inicio = "Cartucho calibre " . self::$calibre . ":";
        $corpo = " Trata-se de " . converter_numero(self::$quantidade) . " cartucho intacto da marca " . self::$marca . " e calibre nominal " . self::$calibre . ", constituído de estojo $municao->estojo, com projétil $municao->tipo_projetil e $municao->projetil.";
        $resultado = self::funcionamento_cartucho($municao->funcionamento);
        $resultadofinal = self::cartucho_obs($municao->funcionamento);
        return ['inicio' => $inicio, 'corpo' => $corpo, 'resultado' => $resultado, 'resultadofinal'=>$resultadofinal];
    }

    private static function cartuchos_arma_curta_deflagrados($municao)
    {
        $inicio = "Cartuchos calibre " . self::$calibre . ":";
        $corpo = " Trata-se de " . converter_numero(self::$quantidade) . " cartuchos intactos da marca " . self::$marca . " e calibre nominal " . self::$calibre . ", constituídos de estojo $municao->estojo, com projétil $municao->tipo_projetil e $municao->projetil.";
        $resultado = self::funcionamento_cartuchos($municao->funcionamento);
        $resultadofinal = self::cartucho_obs($municao->funcionamento);
        return ['inicio' => $inicio, 'corpo' => $corpo, 'resultado' => $resultado, 'resultadofinal'=>$resultadofinal];
    }

    private static function cartucho_arma_curta_nao_deflagrado($municao)
    {
        $inicio = "Cartucho calibre " . self::$calibre . ":";
        $corpo = " Trata-se de " . converter_numero(self::$quantidade) . " cartucho percutido e não deflagrado da marca " . self::$marca . " e calibre nominal " . self::$calibre . ", constituído de estojo $municao->estojo, com projétil $municao->tipo_projetil e $municao->projetil.";
        $resultado = self::funcionamento_cartucho($municao->funcionamento);
        $resultadofinal="Observação: O estojo acima descrito devidamente identificado com o lacre $municao->lacrecartucho, permanecerá sob custódia da POLÍCIA CIENTÍFICA DO PARANÁ.";
        return ['inicio' => $inicio, 'corpo' => $corpo, 'resultado' => $resultado,'resultadofinal'=>$resultadofinal];
    }

    private static function cartuchos_arma_curta_nao_deflagrados($municao)
    {
        $inicio = "Cartuchos calibre " . self::$calibre . ":";
        $corpo = " Trata-se de " . converter_numero(self::$quantidade) . " cartuchos percutidos e não deflagrados da marca " . self::$marca . " e calibre nominal " . self::$calibre . ", constituídos de estojo $municao->estojo, com projétil $municao->tipo_projetil e $municao->projetil.";
        $resultado = self::funcionamento_cartuchos($municao->funcionamento);
        $resultadofinal="Observação: O estojo acima descrito devidamente identificado com o lacre $municao->lacrecartucho, permanecerá sob custódia da POLÍCIA CIENTÍFICA DO PARANÁ.";
        return ['inicio' => $inicio, 'corpo' => $corpo, 'resultado' => $resultado,'resultadofinal'=>$resultadofinal];
    }


    /*---- Cartucho(s) de Arma Longa ------*/

    private static function cartucho_arma_longa_deflagrado($municao)
    {
        $inicio = "Cartucho calibre " . self::$calibre . ":";
        $corpo = " Trata-se de " . converter_numero(self::$quantidade) . " cartucho intacto da marca " . self::$marca . " e calibre nominal " . self::$calibre . ", constituído de estojo $municao->estojo, com carga de projeção em $municao->projetil.";
        $resultado = self::funcionamento_cartucho($municao->funcionamento);
        $resultadofinal = self::cartucho_obs($municao->funcionamento);
        return ['inicio' => $inicio, 'corpo' => $corpo, 'resultado' => $resultado,'resultadofinal'=>$resultadofinal];
    }

    private static function cartuchos_arma_longa_deflagrados($municao)
    {
        $inicio = "Cartuchos calibre " . self::$calibre . ":";
        $corpo = " Trata-se de " . converter_numero(self::$quantidade) . " cartuchos intactos da marca " . self::$marca . " e calibre nominal " . self::$calibre . ", constituídos de estojo $municao->estojo, com carga de projeção em $municao->projetil.";
        $resultado = self::funcionamento_cartuchos($municao->funcionamento);
        $resultadofinal = self::cartucho_obs($municao->funcionamento);
        return ['inicio' => $inicio, 'corpo' => $corpo, 'resultado' => $resultado, 'resultadofinal'=>$resultadofinal];
    }

    private static function cartucho_arma_longa_nao_deflagrado($municao)
    {
        $inicio = "Cartucho calibre " . self::$calibre . ":";
        $corpo = " Trata-se de " . converter_numero(self::$quantidade) . " cartucho percutido e não deflagrado da marca " . self::$marca . " e calibre nominal " . self::$calibre . ", constituído de estojo $municao->estojo, com carga de projeção em $municao->projetil.";
        $resultado = self::funcionamento_cartucho($municao->funcionamento);
        $resultadofinal ="Observação: O estojo acima descrito devidamente identificado com o lacre $municao->lacrecartucho, permanecerá sob custódia da POLÍCIA CIENTÍFICA DO PARANÁ.";
        return ['inicio' => $inicio, 'corpo' => $corpo, 'resultado' => $resultado,'resultadofinal'=>$resultadofinal];
    }

    private static function cartuchos_arma_longa_nao_deflagrados($municao)
    {   
       
        $inicio = "Cartuchos calibre " . self::$calibre . ":";
        $corpo = " Trata-se de " . converter_numero(self::$quantidade) . " cartuchos percutidos e não deflagrados da marca " . self::$marca . " e calibre nominal " . self::$calibre . ", constituídos de estojo $municao->estojo, com carga de projeção em $municao->projetil.";
        $resultado = self::funcionamento_cartuchos($municao->funcionamento);
        $resultadofinal ="Observação: Os estojos acima descrito devidamente identificado com o lacre $municao->lacrecartucho, permanecerá sob custódia da POLÍCIA CIENTÍFICA DO PARANÁ.";
        return ['inicio' => $inicio, 'corpo' => $corpo, 'resultado' => $resultado, 'resultadofinal'=>$resultadofinal];
    }

    /* -- Funcionamento -- */
    public static function funcionamento_cartucho($funcionamento)
    {
        if ($funcionamento == 'eficiente') {
            return 'Submetida esta munição à prova de disparo, foi observado o funcionamento normal dos seus componentes. Foram utilizados para os tiros de prova, todos os cartuchos encaminhados, os quais deflagraram as respectivas cargas de projeção ao serem as espoletas percutidas por uma só vez.';
        }
        if ($funcionamento == 'ineficiente') {
            return 'Submetida esta munição à prova de disparo, foi observado o funcionamento anormal dos seus componentes, estando a mesma ineficiente';
        }
    }

    public static function funcionamento_cartuchos($funcionamento)
    {
        if ($funcionamento == 'eficiente') {
            return 'Submetidas estas munições à prova de disparo, foi observado o funcionamento normal dos seus componentes. Foram utilizados para os tiros de prova, todos os cartuchos encaminhados, os quais deflagraram as respectivas cargas de projeção ao serem as espoletas percutidas por uma só vez.';
        }
        if ($funcionamento == 'ineficiente') {
            return 'Submetidas estas munições à prova de disparo, foi observado o funcionamento anormal dos seus componentes, estando as mesmas ineficientes.';
        }
    }
    public static function cartucho_obs($funcionamento)
    {
        if($funcionamento == 'eficiente'){
            return 'OBS: Conforme o POP de Balística da SENASP, nenhum estojo decorrente do teste de eficiência de munição para arma de fogo deverá retornar para a autoridade requisitante da perícia. Todo o material remanescente deverá ser destruído/descartado ou catalogado e arquivado, quando for o caso.';
        }
        if($funcionamento == 'ineficiente'){
            return 'OBS: Conforme o POP de Balística da SENASP, nenhum estojo decorrente do teste de eficiência de munição para arma de fogo deverá retornar para a autoridade requisitante da perícia. Todo o material remanescente deverá ser destruído/descartado ou catalogado e arquivado, quando for o caso.';
        }
    }
    
}