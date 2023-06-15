<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Models\Gerador;

use App\Models\FormularioInspecao;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\Style\Section;
use PhpOffice\PhpWord\Style\Border;
use Illuminate\Http\UploadedFile;
use PhpOffice\PhpWord\Element\Image;


class FormularioInspecaoText 
{
    
    private $section, $config, $phpWord;

    public function __construct($section, $config,$phpWord)
    {
        
        $this->section = $section;
        $this->config = $config;
        
        $this->phpWord=$phpWord;
    }

    
    public function img64base($a){

        $imageR = $a; // decodifica do banco a image em base 64
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageR)); // tira #^data:image/\w+;base64,#i
           
        $tempFilePath = sys_get_temp_dir() . '/' . uniqid() . '.jpg'; // cria um diretorio temporario
         file_put_contents($tempFilePath, $imageData);//colocar arquivo
         
        // quando a image vêm de um input do tipo file não precisa transforma em um objeto porque ela já é, porem quando ta em base64 sim ae se usa o UploadedFile
          $imageConvertida = new UploadedFile($tempFilePath, 'diario_num_one.jpg', 'image/jpeg', null, true);
       
            
        $fileC = file_get_contents($imageConvertida); //pegar arquivo
        return $fileC;
    }
    


    public function addText($a)
    {
        
        if($a->veiculo=="Duster"){
            $imgFrente = public_path('image/dusterFrente.png');
            $imgTraseira = public_path('image/dusterTraseira.png');
            $imgLateralEsquerda = public_path('image/dusterLateralEsquerda.png');
            $imgLateralDireita = public_path('image/dusterLateralDireita.png');
        }else{
            $imgFrente = public_path('image/caminhoneteFrente.png');
            $imgTraseira = public_path('image/caminhoneteTraseira.png');
            $imgLateralEsquerda = public_path('image/caminhoneteLateralEsquerda.png');
            $imgLateralDireita = public_path('image/caminhoneteLateralDireita.png');
        }

        $imageFrente=$this->img64Base($a->imagem_base64Frent);
        $imageEsq=$this->img64Base($a->imagem_base64LatEsq);
        $imageLat=$this->img64Base($a->imagem_base64Lat);
        $imageTra=$this->img64Base($a->imagem_base64Tran);



        $fontStyle = array ('bold' => false); 
        $fontNegrito = array ('bold' => true); 
        $stileFontcheck = array ('bold' => true,'color'=>'#FFFFFF'); 
        $paraStyle = array ('align' =>'center');
       
        $formulario= new FormularioInspecao;
        $formulario=$formulario->all();
        $form=count($formulario)-1;
        $formulario[$form];//pegando o ultimo formulario

        $source = public_path('image/logo-sem-fundo.png');
        $simboloparana = public_path('image/simboloparana.jpg');
        $fileContent = file_get_contents($source);
        
        $table = $this->section->addTable('tabela1');
        
        $table->addRow(null,['tblHeader'=>true]);
        $table->addCell(1200)->addImage($source,array('alignment' => Jc::LEFT, 'width' => 50, 'height'=>50));
        $rer=$table->addCell(7800);
        $rer->addText("FORMULÁRIO DE INSPEÇÃO", $this->config->arial14Bold(),array('alignment' => Jc::CENTER));
       
        $table->addCell(1200)->addImage($simboloparana,array('alignment' => Jc::RIGHT, 'width' => 50, 'height'=>50));

        $this->section->addTextBreak(1);
        $table = $this->section->addTable('tabela5');
        $table->addRow();
        $table->addCell(3450)->addText("Cidade: $a->cidade_id");
        $table->addCell(3450)->addText("Unidade: $a->secao_id");
        $table->addCell(3433)->addText("Data e Hora: ".formatar_data_do_bd($a->data).' '.$a->hora);
        
        $table->addRow();
        $table->addCell()->addText("Veiculo: $a->veiculo");
        $table->addCell()->addText("Placa: $a->placa");
        $table->addCell()->addText("Condutor: $a->condutor");
        $table->addCell()->addText("KM: $a->km");
        $table->addRow();
        $table->addCell(10300)->addText("Verifique o cartão de abastecimento ",$fontNegrito ,$paraStyle);
        $table->addRow();
        $table->addCell(10300,array('bgColor'=>'#FF0000'))->addText("CHECK LIST VEÍCULAR ",$stileFontcheck ,$paraStyle);
        $table->addRow();
        $table->addCell(10300)->addText("DESENHO DAS AVARIAÇÕES ENCONTRADAS NO VEICULO",$fontNegrito ,$paraStyle);
        $table->addRow();
        $table->addCell(1200)->addImage(empty($imageFrente)?$imgFrente:$imageFrente,array('alignment' => Jc::CENTER, 'width' => 100, 'height'=>100));
        $table->addCell(1200)->addImage(empty($imageEsq)?$imgLateralEsquerda:$imageEsq,array('alignment' => Jc::CENTER, 'width' => 200, 'height'=>100));
        
        $table->addRow();
        $table->addCell(1200)->addImage(empty($imageLat)?$imgLateralDireita:$imageLat,array('alignment' => Jc::CENTER, 'width' => 200, 'height'=>100));
        $table->addCell(1200)->addImage(empty($imageTra)?$imgTraseira:$imageTra,array('alignment' => Jc::CENTER, 'width' => 100, 'height'=>100));
        
        $this->section->addTextBreak(1);

        
        
    $table = $this->section->addTable('tabela99');
       $table->addRow();
       $table->addCell(2575)->addText($a->condicao=="riscado"?"RISCADO( X )":"RISCADO(  )",$fontStyle,$paraStyle);
       $table->addCell(2575)->addText($a->condicao=="amassado"?"AMASSADO( X )":"AMASSADO(  )",$fontStyle,$paraStyle);
       $table->addCell(2575)->addText($a->condicao=="quebrado"?"QUEBRADO( X )":"QUEBRADO(  )",$fontStyle,$paraStyle);
       $table->addCell(2575)->addText($a->condicao=="sem danos"?"SEM DANOS( X )":"SEM DANOS(  )",$fontStyle,$paraStyle);
       $this->section->addTextBreak(1);
    $table = $this->section->addTable('tabela99');   
       $table->addRow();
       $table->addCell(2150)->addText("CONDIÇÕES DOS PNEUS",$fontNegrito ,$paraStyle);
       $table->addCell(2000)->addText($a->pneu=="novo"?"NOVOS( X )":"NOVO(  )",$fontStyle,$paraStyle);
       $table->addCell(2000)->addText($a->pneu=="bom"?"BONS( X )":"BONS(  )",$fontStyle,$paraStyle);
       $table->addCell(2000)->addText($a->pneu=="limite"?"NO LIMITE TWI( X )":"NO LIMITE TWI(  )",$fontStyle,$paraStyle);
       $table->addCell(2150)->addText($a->pneu=="semcondicao"?"SEM CONDIÇÕES( X )":"SEM CONDIÇÕES(  )",$fontStyle,$paraStyle);
       $this->section->addTextBreak(1);
    $table = $this->section->addTable('tabela99');
       $table->addRow(null);
       $table->addCell(2000,array('bgColor'=>'#D3D3D3'))->addText("VISTORIA BÁSICA",$fontNegrito,null);
       $table->addCell(900,array('bgColor'=>'#D3D3D3'))->addText("SIM",$fontNegrito ,$paraStyle);
       $table->addCell(900,array('bgColor'=>'#D3D3D3'))->addText("NÃO",$fontNegrito ,$paraStyle);
       $table->addCell(6500,array('bgColor'=>'#D3D3D3'))->addText("AVARIADO (DESCREVA)",$fontNegrito ,$paraStyle);
      
       $table->addRow();
       $table->addCell()->addText("ESTEPE",$fontStyle,null);
       $table->addCell()->addText($a->estepe=="sim"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->estepe=="nao"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->estobs,$fontStyle,$paraStyle);
       $table->addRow();
       $table->addCell()->addText("TRIÂNGULO",$fontStyle,null );
       $table->addCell()->addText($a->triangulo=="sim"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->triangulo=="nao"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->triobs,$fontStyle,$paraStyle);
       $table->addRow();
       $table->addCell()->addText("CHAVE DE RODAS",$fontStyle,null);
       $table->addCell()->addText($a->chaveroda=="sim"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->chaveroda=="nao"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->chaobs,$fontStyle,$paraStyle);
       $table->addRow();
       $table->addCell()->addText("MACACO",$fontStyle,null);
       $table->addCell()->addText($a->macaco=="sim"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->macaco=="nao"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->macoobs,$fontStyle,$paraStyle);
       $this->section->addTextBreak(2);
       $table = $this->section->addTable('tabela99');
       $table->addRow(null,array('bgColor'=>'#D3D3D3'));
       $table->addCell(5000,array('bgColor'=>'#D3D3D3'))->addText("DEMAIS COMPONENTES/FLUÍDOS",$fontNegrito ,null);
       $table->addCell(900,array('bgColor'=>'#D3D3D3'))->addText("BOM",$fontNegrito ,$paraStyle);
       $table->addCell(900,array('bgColor'=>'#D3D3D3'))->addText("RUIM",$fontNegrito ,$paraStyle);
       $table->addCell(3500,array('bgColor'=>'#D3D3D3'))->addText("FALTANTE (DESCREVA)",$fontNegrito ,$paraStyle);
       
       $table->addRow();
       $table->addCell()->addText("NÍVEL DE ÓLEO MOTOR",$fontStyle ,null);
       $table->addCell()->addText($a->oleo=="Bom"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->oleo=="ruim"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->oleoobs,$fontStyle,$paraStyle);
       $table->addRow();
       $table->addCell()->addText("NIVEL DE ÁGUA MOTOR",$fontStyle ,null);
       $table->addCell()->addText($a->agua=="Bom"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->agua=="ruim"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->aguaobs,$fontStyle,$paraStyle);
       $table->addRow();
       $table->addCell()->addText("ÁGUA DO LIMPADOR",$fontStyle ,null);
       $table->addCell()->addText($a->agualimpador=="Bom"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->agualimpador=="ruim"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->limpadorobs,$fontStyle,$paraStyle);
       $table->addRow();
       $table->addCell()->addText("PALHETA DE PARABRISA",$fontStyle,null);
       $table->addCell()->addText($a->palheta=="Bom"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->palheta=="ruim"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->palhetaobs,$fontStyle,$paraStyle);
       $table->addRow();
       $table->addCell()->addText("ILUMINAÇÃO/ FAROIS/SETAS",$fontStyle,null);
       $table->addCell()->addText($a->faroes=="Bom"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->faroes=="ruim"?" X ":"  ",$fontStyle,$paraStyle);
       $table->addCell()->addText($a->faroisobs,$fontStyle,$paraStyle);
       $this->section->addTextBreak(2);
       $table = $this->section->addTable('tabela99');
       $table->addRow();
       $table->addCell(10300)->addText("DEMAIS CONSIDERAÇÕES / SUGESTÕES",$fontNegrito ,$paraStyle);
       $table->addRow();
       $table->addCell()->addText($a->observacao);
       $table = $this->section->addTable('tabela99');
       $this->section->addTextBreak(2);
       $table->addRow();
       $table->addCell()->addText("DECLARO QUE ME RESPONSABILIZO PELO VEÍCULO E TODOS OS BENS E EQUIPAMENTOS, BEM COMO A CONSERVAÇÃO DO MESMO.",$fontNegrito ,$paraStyle);
       $table->addRow();
       $cell=$table->addCell();
       $cell->addText("NOME COMPLETO E RG ",$fontNegrito,$paraStyle);
       $cell->addText("NOME:",$fontNegrito,NULL);
       $cell->addText("RG: $a->rg",$fontNegrito,NULL);
       $cell2=$table->addCell();
       $cell2->addText("ASSINATURA ",$fontNegrito,$paraStyle);
       $cell2->addText("");

}       
            
}       
            
           
        

            
   

       
        
        
        
       
         