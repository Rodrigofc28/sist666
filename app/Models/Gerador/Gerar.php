<?php


namespace App\Models\Gerador;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Style\Language;

$i=0;
class Gerar
{
    private $phpWord;
    private $section;
    private $conf;
    private $phpW;
    private $geral;

    public function __construct()
    {
        $this->phpWord = new PhpWord();
        $this->conf = new Config($this->phpWord);
        $this->section = $this->conf->getSection();
        $this->phpW = $this->phpWord;
    }

    public function create_docx($a=null,$b=null)
    {
        
        
        $this->phpW->getSettings()->setThemeFontLang(new Language(Language::PT_BR));
        Settings::setOutputEscapingEnabled(true);

         
        $this->geral = new Geral($this->section, $this->conf, $this->phpW);
            
        $this->geral->addText($a,$b);
        
       
        $footer=$this->section->addFooter();
       
       

        $objWriter = IOFactory::createWriter($this->phpW, 'Word2007');
        $randomico=rand(1,9999);
        $nome_arquivo = 'diario_de_bordo ' . str_replace("/", "-", $randomico) . '.docx';

        if (!is_dir(storage_path('/laudos'))) {
            mkdir(storage_path('/laudos'), 0755, true);
        };

        try {
           
            $objWriter->save(storage_path('laudos/' . $nome_arquivo));
            
        } catch (Exception $e) {
            echo "erro";
        }
        return response()->download(storage_path('laudos/' . $nome_arquivo));
        
    }
    public function create_docx_formulario($a)
    {
        
        
        $this->phpW->getSettings()->setThemeFontLang(new Language(Language::PT_BR));
        Settings::setOutputEscapingEnabled(true);

         
        $this->geral = new FormularioInspecaoText($this->section, $this->conf, $this->phpW);
        $this->geral->addText($a);
     
        $footer=$this->section->addFooter();
     
        $objWriter = IOFactory::createWriter($this->phpW, 'Word2007');
        $randomico=rand(1,9999);
        $nome_arquivo = 'diario_de_bordo ' . str_replace("/", "-", $randomico) . '.docx';

        if (!is_dir(storage_path('/laudos'))) {
            mkdir(storage_path('/laudos'), 0755, true);
        };

        try {
           
            $objWriter->save(storage_path('laudos/' . $nome_arquivo));
            
        } catch (Exception $e) {
            echo "erro";
        }
        return response()->download(storage_path('laudos/' . $nome_arquivo));
        
    }
}
