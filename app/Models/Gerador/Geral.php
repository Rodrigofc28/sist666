<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Models\Gerador;

use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\Border;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Shape;
use PhpOffice\PhpWord\Style\Font;
use Illuminate\Http\UploadedFile;
use PhpOffice\PhpWord\Element\Image;
class Geral 
{
    public $section, $config, $phpWord;//mudei de private para public

    public function __construct($section, $config, $phpWord)
    {
        
        $this->section = $section;
        $this->config = $config;
        $this->phpWord = $phpWord;
    }
   
     
       
    
    public function addText($users,$b)
    {
        
      
        $source = public_path('image/logo.jpg');
        $sourceImg2 = public_path('image/simboloparana.jpg');
        //$fileContent = file_get_contents($source);
        
        $table = $this->section->addTable('tabela');
        $table->addRow(null,['tblHeader'=>true]);
        $table->addCell(1200)->addImage($source,array('alignment' => Jc::LEFT, 'width' => 50, 'height'=>50));
        $rer=$table->addCell(8000);
        $rer->addText("DIÁRIO DE BORDO - POLÍCIA CIENTÍFICA PARANÁ", $this->config->arial14Bold(),array('alignment' => Jc::CENTER));
        $rer->addText('UNIDADE: '.$b.' VTR: '.$users[0]->vtr,$this->config->arial14Bold(),array('alignment' => Jc::CENTER));
        $table->addCell(1200)->addImage($sourceImg2,array('alignment' => Jc::RIGHT, 'width' => 50, 'height'=>50));

        $fontStyle = array ('bold' => true); 
        $paraStyle = array ('align' =>'center');
        $styleTable = array('borderColor'=>'#000000','borderSize'=>10, 'cellMarginTop'=>10,'cellMarginLeft'=>0,'cellMarginRight'=>0,'cellSpacing'=>10000); //configuração da borda
        $styleFirstRow = array('bgColor'=>'#D9D9D9');
        $cellStyle=array('borderSize'=>50);
        $styleBorder = array('borderColor'=>'#FFFFFF','borderSize'=>10);
        
        $this->phpWord->addTableStyle('tabela', $styleBorder); //cabeçalho da tabela
        $this->phpWord->addTableStyle('tabela2img', $styleTable, $styleFirstRow);
        
        

        $this->section->addTextBreak(1);
            $table = $this->section->addTable('tabela2img');
        $table->addRow();
        $table->addCell(600,['bgColor'=>'D9D9D9'])->addText("Data",$fontStyle,$paraStyle);
        $table->addCell(600,['bgColor'=>'D9D9D9'])->addText("Hora Saída",$fontStyle,$paraStyle);
        $table->addCell(1550,['bgColor'=>'D9D9D9'])->addText("Motorista",$fontStyle,$paraStyle);
        $table->addCell(1900,['bgColor'=>'D9D9D9'])->addText("Destino",$fontStyle,$paraStyle);
        $table->addCell(900,['bgColor'=>'D9D9D9'])->addText("Km Inicial",$fontStyle,$paraStyle);
        $table->addCell(1600,['bgColor'=>'D9D9D9'])->addText("Combustível",$fontStyle,$paraStyle);
        $table->addCell(900,['bgColor'=>'D9D9D9'])->addText("Km Final",$fontStyle,$paraStyle);
        $table->addCell(1600,['bgColor'=>'D9D9D9'])->addText("Combustível",$fontStyle,$paraStyle);
        $table->addCell(600,['bgColor'=>'D9D9D9'])->addText("Hora Chegada",$fontStyle,$paraStyle);
        
        foreach($users as $user){
            $dataFormatada = date('d/m/Y', strtotime($user->data_recebimento));
            $table->addRow();
            $imgUM = $this->img64Base($user->imagem_base64);
            $imgDois = $this->img64Base($user->imagemFinal_base64);
            $table->addCell()->addText($dataFormatada,null,$paraStyle); 
            $table->addCell()->addText($user->horaSaida,null,$paraStyle); 
            $table->addCell()->addText($user->nome_motorista,null,$paraStyle); 
            $table->addCell()->addText($user->cidade_id,null,$paraStyle); 
            $table->addCell()->addText($user->KMinicial,null,$paraStyle);
            $table->addCell()->addImage($imgUM,array('alignment' => Jc::RIGHT, 'width' => 80, 'height'=>30));
            $table->addCell()->addText($user->KMfinal,null,$paraStyle);
            $table->addCell()->addImage($imgDois,array('alignment' => Jc::RIGHT, 'width' => 80, 'height'=>30));
            $table->addCell()->addText($user->horaChegada,null,$paraStyle);
         
           
          
          
        }
           
            
        return $this->section;

    }

    
    public function img64base($a){

        $imageR = base64_decode($a); // decodifica do banco a image em base 64
        
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageR)); // tira #^data:image/\w+;base64,#i
           
        $tempFilePath = sys_get_temp_dir() . '/' . uniqid() . '.jpg'; // cria um diretorio temporario
         file_put_contents($tempFilePath, $imageData);//colocar arquivo
         
        // quando a image vêm de um input do tipo file não precisa transforma em um objeto porque ela já é, porem quando ta em base64 sim ae se usa o UploadedFile
          $imageConvertida = new UploadedFile($tempFilePath, 'diario_num_one.jpg', 'image/jpeg', null, true);
       
            
        $fileC = file_get_contents($imageConvertida); //pegar arquivo
        return $fileC;
    }


 
    

    public function imagem($laudo){
        
        $i=0;
        $contagem=[];
        $imagens = $laudo->imagens;
       
        if ($imagens->count() > 0) {
            foreach ($imagens as $imagem) {
                $source = storage_path('app/public/imagensEmbalagem/' . $imagem->nome);
                if (file_exists($source)) {
                    $fileContent = file_get_contents($source);
                    
                    $contagem[$i]=$fileContent;
                    
                } else {
                    $this->section->addText("Ocorreu um erro com a imagem.", ['color' => "FF0000", 'size' => 14]);
                }
                $i++;
            }
            return $contagem;
        }


    }

   
}


