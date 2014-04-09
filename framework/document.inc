<?php

include 'ext/mpdf/mpdf.php';

/**
 * Class documents
 * Für Vereinfachtes Abfrage und Anlegen von Dateien
 */
class document{
    private $file;

    public function createPDF(){
        $mpdf=new mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;
        $mpdf->WriteHTML(file_get_contents($this->file));
        $mpdf->Output();
    }

    public function setDocument($file){
        $this->file=$file;
    }
    /**
     * @return array
     */
    public function getCSVAsArray(){
        return file($this->file);
    }

    /**
     * @return string
     */
    public function getCSVAsString(){
        $content = file($this->file);
        $text='';
        foreach($content as $element){
            $text.=$element;
        }
        return $text;
    }

    /**
     * @param string $needle Zu suchender Text
     * @param bool $wanted bei true werden nur Zeilen mit und bei false nur Zeilen ohne den text gesucht
     * @return array
     */
    public function getCSVAsArrayFiltered($needle,$wanted=true){
        $file = file($this->file);
        $output= array();
        if($wanted){
            foreach($file as $element){
                if(strpos($element,$needle)) $output[].=$element;
            }
        }
        else{
            foreach($file as $element){
                if(!strpos($element,$needle)) $output[].=$element;
            }
        }
        return $output;
    }

    /**
     * @param array $content Zu schreibender Inhalt, auch als string übergebbar
     * @param bool $expand standardmäßig false, bei true wird die Datei nur erweitert
     */
    public function writeCSV($content,$expand=false){
        if(!is_array($content))$content = array($content);
        if($expand==true) $text = $this->getCSVAsString($this->file)."\n";
        else $text='';
        foreach($content as $element){
            $text.=$element;
        }
        $filehandle = fopen($this->file, 'w');
        fwrite($filehandle,$text);
        fclose($filehandle);
    }

}