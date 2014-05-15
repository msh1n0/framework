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
    private $hidden=false;

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
    public function setHiddenMode($input){
        $this->hidden=$input;
    }
    public function resizeMap($width){
        if($this->image->getWidth()!=$width) $this->image->resampleImage($width,'','resize',array(0,0,0));
    }
    public function generatePointers($input,$xattr, $yattr){
        $pointers='';
        $pxPerCol=round($this->image->getWidth()/$this->cols);
        $x='';
        $y='';
        foreach($input as $user){
            $x=($pxPerCol*$user['pointerx'])-$pxPerCol;
            $y=($pxPerCol*$user['pointery'])-$pxPerCol;
            $bgpos='';
            if($this->hidden==true)$bgpos='background:url('.$this->image->getFilename().');background-position:-'.$x.'px -'.$y.'px;';
            $pointers.='<div class="pointer" style="position:absolute;z-index:10;width:'.$pxPerCol.';height:'.$pxPerCol.';margin:'.$y.'px 0 0 '.$x.'px;'.$bgpos.'"><img src="templates/system/_resources/images/map/marker_'.$user['color'].'.png"></div>';

        }
        return $pointers;
    }
    public function getMap(){
        if($this->hidden) return $this->generateMapGrid($this->cols).'<div style="width:'.$this->image->getWidth().'px;height:'.$this->image->getHeight().'px;background:#000;"></div>';
        else return $this->generateMapGrid($this->cols).'<img id="map" src="'.$this->image->getFilename().'" style="width:'.$this->image->getWidth().'px;height:'.$this->image->getHeight().'px;position:absolute;z-index:5"><div style="width:'.$this->image->getWidth().'px;height:'.$this->image->getHeight().'px;"></div>';
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