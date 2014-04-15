<?php

class map{
    private $image;
    function __construct($imagePath){
        $this->image=new image();
        $this->image->setFile($imagePath);
    }

    /**
     * @param $cols
     * @param $rows
     * @return array vorbereitet für die Übergabe in Smarty
     * @throws InputErrorException
     */
    public function prepareMap($cols,$rows){
        if($cols==''){
            if($rows=='') throw new InputErrorException('Bitte Gridgröße angeben');
            $cols=round($this->image->getWidth()/($this->image->getHeight()/$rows));
        }
        else if($rows==''){
            if($cols=='') throw new InputErrorException('Bitte Gridgröße angeben');
            $rows=round($this->image->getHeight()/($this->image->getWidth()/$cols));
        }
        return array(array('mapboard',$this->generateMapGrid($cols, $rows)),array('mapboard_css',$this->generateMapGridCSS()));
    }

    private function generateMapGrid($cols, $rows){
        $output='<table class="mapboard" cellpadding="0" cellspacing="0">';
        for($row=1;$row<=$rows;$row++){
            $output.='<tr>';
            for($col=1;$col<=$cols;$col++){
                $output.='<td id="'.$row.'_'.$col.'" class=""></td>';
            }
            $output.='</tr>';
        }
        $output.='</table>';
        return $output;
    }

    private function generateMapGridCSS(){
       /*
        * css für marker: background:url(framework/template/system/_resources/images/map/marker_f00.png) 50% 50% no-repeat; background-size:80%;
        *
        * */

        $css='<style>.container{min-width:'.($this->image->getWidth()+60).'px;max-width:'.($this->image->getWidth()+60).'px;width:'.($this->image->getWidth()+60).'px;}
        .mapboard{min-width:'.$this->image->getWidth().'px;width:'.($this->image->getWidth()+60).'px;min-height:'.$this->image->getHeight().'px;height:'.$this->image->getHeight().'px;background:url('.$this->image->getFilename().') no-repeat;background-size:contain}
        .mapboard td{cursor:pointer}
        .mapboard td:hover{box-shadow:inset 0 0 3px #000;}</style>';
        return $css;
    }

} 