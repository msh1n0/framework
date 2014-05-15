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
    private $cols;

    /**
     * @param $imagePath
     */
    function __construct($imagePath){
        $this->image=new image();
        $this->image->setFile($imagePath);
    }
    public function setCols($cols){
        $this->cols=$cols;
    }
    public function resizeMap($width){
        if($this->image->getWidth()!=$width) $this->image->resampleImage($width,'','resize',array(0,0,0));
    }
    public function generatePointers($input,$xattr, $yattr){
        $pointers='';
        foreach($input as $user){
           # $positionx=(int)round($this->image->getWidth()/$this->cols)*$user['pointerx'];
           $pointers.='<div class="pointer">'.$user[$xattr].'-'.$user[$yattr].'</div>';

        }
        return $pointers;
    }
    public function getMap(){
        return $this->generateMapGrid($this->cols).'<img id=""map" src="'.$this->image->getFilename().'" style="width:'.$this->image->getWidth().'px;height:'.$this->image->getHeight().'px;position:absolute;z-index:5"><div style="width:'.$this->image->getWidth().'px;height:'.$this->image->getHeight().'px;"></div>';
    }
    private function generateMapGrid(){

            if($this->cols=='') throw new InputErrorException('Bitte Gridgröße angeben');
            $rows=round($this->image->getHeight()/($this->image->getWidth()/$this->cols));
        $output='<table class="mapboard" cellpadding="0" cellspacing="0" style="width:'.$this->image->getWidth().'px;height:'.$this->image->getHeight().'px;position:absolute;z-index:15">';
        for($row=1;$row<=$rows;$row++){
            $output.='<tr>';
            for($col=1;$col<=$this->cols;$col++){
                $output.='<td id="cell_'.$row.'_'.$col.'" class="cell" onclick="setPointer(\''.$_SESSION['user_id'].'\','.$col.','.$row.')"><div></div></td>';
            }
            $output.='</tr>';
        }
        $output.='</table>';
        return $output;
    }
} 