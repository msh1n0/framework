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
    public function generatePointers($input){
        $pointers='';
        $pxPerCol=$this->image->getWidth()/$this->cols;
        foreach($input as $user){
            if(!empty($user['pointerx'])){
                $x=($pxPerCol*$user['pointerx'])-$pxPerCol;
                $y=($pxPerCol*$user['pointery'])-$pxPerCol;
                if(!empty($user['mapsight']))$newsize=$pxPerCol*(int)$user['mapsight'];
                else $newsize=$pxPerCol;
                $x=$x-(($newsize-$pxPerCol)/2);
                $y=$y-(($newsize-$pxPerCol)/2);

                $bgpos='background:url('.$this->image->getFilename().');background-position:'.($this->image->getWidth()-$x).'px '.($this->image->getHeight()-$y).'px;';
                if($user['id']!='ZIEL')$pointers.='<div class="pointer" style="position:absolute;z-index:10;width:'.$newsize.'px;height:'.$newsize.'px;margin:'.$y.'px 0 0 '.$x.'px;'.$bgpos.'"></div>';
                $pointers.='<div class="pointer" style="position:absolute;z-index:20;width:'.$pxPerCol.'px;height:'.$pxPerCol.'px;margin:'.$y.'px 0 0 '.$x.'px;"><img src="templates/system/_resources/images/map/marker_'.$user['color'].'.png" style="width:'.$pxPerCol.'px;height:'.$pxPerCol.'px;margin:'.(($newsize-$pxPerCol)/2).'px 0 0 '.(($newsize-$pxPerCol)/2).'px;" title="'.$user['id'].'"></div>';

            }
        }
        return $pointers;
    }
    public function getMap(){
        if($this->hidden) return $this->generateMapGrid($this->cols).'<div style="width:'.$this->image->getWidth().'px;height:'.$this->image->getHeight().'px;background:#000;"></div>';
        else return $this->generateMapGrid($this->cols).'<img id="map" src="'.$this->image->getFilename().'" style="width:'.$this->image->getWidth().'px;height:'.$this->image->getHeight().'px;position:absolute;z-index:5"><div style="width:'.$this->image->getWidth().'px;height:'.$this->image->getHeight().'px;background:#000;position:absolute;z-index:7" class="fog"></div><div style="width:'.$this->image->getWidth().'px;height:'.$this->image->getHeight().'px;"></div>';
    }
    private function generateMapGrid(){
            if($this->cols=='') throw new InputErrorException('Bitte Gridgröße angeben');
            $rows=round($this->image->getHeight()/($this->image->getWidth()/$this->cols));
        $output='<table class="mapboard" cellpadding="0" cellspacing="0" style="width:'.$this->image->getWidth().'px;height:'.$this->image->getHeight().'px;position:absolute;z-index:19">';
        for($row=1;$row<=$rows;$row++){
            $output.='<tr>';
            for($col=1;$col<=$this->cols;$col++){
                $output.='<td id="cell_'.$row.'_'.$col.'" class="cell" onclick="setPointer('.$col.','.$row.')"><div></div></td>';
            }
            $output.='</tr>';
        }
        $output.='</table>';
        return $output;
    }
} 