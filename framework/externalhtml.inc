<?php

/**
 * Class externalHTML
 */
class externalHTML {
    /**
     * @var string Inhalt der externen Datei
     */
    private $content;
    /**
     * @var string $url Pfad der Datei, die geladen werden soll
     */
    private $url;

    /**
     * URL setzen, die geladen werden soll
     */
    public function setURL($url){
        $this->url=$url;
        $this->import();
    }

    /**
     * @param string $from String, an dem begonnen werden soll
     * @param bool $fromInclude Bei true ist der Suchtext mit im Ergebnis inbegriffen
     * @param string $to String, bis wohin der Inhalt geschnitten werden soll
     * @param bool $toInclude Bei true ist der Suchtext mit im Ergebnis inbegriffen
     */
    public function cropContent($from,$fromInclude=true,$to='',$toInclude=true){
        if(!$fromInclude) $fromOffset=strlen($from);
        else $fromOffset=0;
        $from = strpos($this->content,$from);
        $this->content=substr($this->content,($from+$fromOffset));

        if($toInclude) $toOffset=strlen($to);
        else $toOffset=0;
        $to = strpos($this->content,$to);
        $this->content=substr($this->content,0,($to+$toOffset));
    }

    /**
     * Links und Verweise in der externen Datei finden und umformen
     */
    public function localise(){
        $position=0;
        while(true){
            $position=(strpos($this->content,'href="',$position));
            if($position=='') break;
            $to=strpos($this->content,'"',$position+6);
            $link=substr($this->content,$position+6, ($to-$position-6));
            $this->content=str_replace($link,$this->repairLink($link),$this->content);
            $position+=strlen($link)+6;
        }
        $position=0;
        while(true){
            $position=(strpos($this->content,'src="',$position));
            if($position=='') break;
            $to=strpos($this->content,'"',$position+5);
            $link=substr($this->content,$position+5, ($to-$position-5));
            $this->content=str_replace($link,$this->repairLink($link),$this->content);
            $position+=strlen($link)+5;
        }
    }

    /**
     * TODO: Alle Bildpfade der externen Datei in einem Array sammeln
     */
    public function getAllImagesAsArray(){
    }

    /**
     * Inhalt der Datei ausgeben
     * @return mixed
     */
    public function getContent(){
        return $this->content;
    }

    /**
     * Kernfunktion, um die Links aufrufbar machen
     * @param $link
     * @return string
     */
    private function repairLink($link){
        if($link=='' || $link=='#')return $link;
        else{
                #return $link;

                if(strpos($link,'http')===0) return $link;
                if(strpos($link,'./')===0) return $this->getURLDirectory().substr($link,2);
                if(strpos($link,'/')===0) return $this->getURLDirectory().substr($link,1);
                else return $this->getURLDirectory().$link;
        }
    }

    /**
     * Verzeichnis der zu ladenen Seite freistellen
     * @return string
     */
    private function getURLDirectory(){
        $position=strrpos($this->url,'/');
        return substr($this->url,0,$position+1);
    }

    /**
     * Externe Datei laden
     */
    private function import(){
        $this->content=file_get_contents($this->url);
    }
} 