<?php

/**
 * Class map
 * TODO: getmap() - Karte in HTML generieren
 * TODO: setPointer(col,row) - Pointer im Objekt anmelden
 * TODO: getwidth()
 * TODO: getHeight()
 * TODO: getPointers() - alle Pointer ausgeben (ajax)
 * TODO: hiddenmode() - Karte schwarz und Pointer tragen die Karte
 * TODO:
 */
class map{
    /**
     * @var image
     */
    private $image;

    /**
     * @param $imagePath
     */
    function __construct($imagePath){
        $this->image=new image();
        $this->image->setFile($imagePath);
    }

    public function resizeMap($width){
        if($this->image->getWidth()!=$width) $this->image->resampleImage($width,'','resize',array(0,0,0));
    }
    public function getMap($cols){

        return $this->generateMapGrid($cols).'<img id=""map" src="'.$this->image->getFilename().'" style="width:'.$this->image->getWidth().'px;height:'.$this->image->getHeight().'px;position:absolute;z-index:5"><div style="width:'.$this->image->getWidth().'px;height:'.$this->image->getHeight().'px;"></div>';
    }
    private function generateMapGrid($cols){
            if($cols=='') throw new InputErrorException('Bitte Gridgröße angeben');
            $rows=round($this->image->getHeight()/($this->image->getWidth()/$cols));
        $output='<table class="mapboard" cellpadding="0" cellspacing="0" style="width:'.$this->image->getWidth().'px;height:'.$this->image->getHeight().'px;position:absolute;z-index:15">';
        for($row=1;$row<=$rows;$row++){
            $output.='<tr>';
            for($col=1;$col<=$cols;$col++){
                $output.='<td id="cell_'.$row.'_'.$col.'" class="cell"><div></div></td>';
            }
            $output.='</tr>';
        }
        $output.='</table>';
        return $output;
    }
} 