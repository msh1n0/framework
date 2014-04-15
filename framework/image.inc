<?php

/**
 * Class image
 * TODO: Wasserzeichen, Rahmen, Texte, Verarbeitung in Datei ablegen beim Resize
 */
class image{
    private $filename;
    private $width;
    private $height;
    private $mime;

    public function getWidth(){
        return $this->width;
    }
    public function getHeight(){
        return $this->height;
    }
    public function getFilename(){
        return $this->filename;
    }
    public function setFile($filename){
        $this->filename=$filename;
        $this->refresh();
    }
    /**
     * @param int $newWidth Zielbreite des Bildes
     * @param int $newHeight Zielhöhe des Bildes
     * @param string $mode touch-inner, touch-outer oder leer
     * @param array $rgb RGB-Code in Arrayform
     * @return Resource-Object
     * @throws ErrorException
     * @throws BadMethodCallException
     * */
    
    public function resampleImage($newWidth, $newHeight, $mode, array $rgb){
        if($mode=='resize'){
            $ResizeFactor=$newWidth / $this->width;
            $newHeight=$this->height*$ResizeFactor;
        }
        $newImage = imagecreatetruecolor($newWidth,$newHeight);
        imagefill($newImage, 0, 0, imagecolorallocate($newImage,$rgb[0],$rgb[1],$rgb[2]));

        if(!touch($this->filename)) throw(new ErrorException('Zugriff auf die Datei wurde verweigert'));
        if($this->mime=='image/jpeg') $ImageInput = imagecreatefromjpeg($this->filename);
        elseif($this->mime=='image/png') $ImageInput = imagecreatefrompng($this->filename);
        else throw(new BadMethodCallException('Dateiformat nicht unterstützt'));

        switch($mode){
            case 'touch-inner':
                if ($this->height>$this->width){  //Portrait
                    $ResizeFactor=$newHeight / $this->height;
                    $margin=round(($newWidth-($this->width*$ResizeFactor))/2);
                    imagecopyresampled($newImage, $ImageInput, $margin,0,0 ,0,$this->width*$ResizeFactor,$this->height*$ResizeFactor,$this->width,$this->height);

                }
                else{
                    $ResizeFactor=$newWidth / $this->width;
                    $margin=round(($newHeight-($this->height*$ResizeFactor))/2);
                    imagecopyresampled($newImage, $ImageInput, 0,$margin,0 ,0,$this->width*$ResizeFactor,$this->height*$ResizeFactor,$this->width,$this->height);
                }
                break;
            case 'touch-outer':
                if ($this->height>$this->width){  //Portrait
                    $ResizeFactor=$newWidth / $this->width;
                    $margin=round(($newHeight-($this->height*$ResizeFactor))/2);
                    imagecopyresampled($newImage, $ImageInput, 0,$margin,0 ,0,$this->width*$ResizeFactor,$this->height*$ResizeFactor,$this->width,$this->height);
                }
                else{
                    $ResizeFactor=$newHeight / $this->height;
                    $margin=round(($newWidth-($this->width*$ResizeFactor))/2);
                    imagecopyresampled($newImage, $ImageInput, $margin,0,0 ,0,$this->width*$ResizeFactor,$this->height*$ResizeFactor,$this->width,$this->height);
                }
                break;
            case 'resize':
                if ($this->height>$this->width){  //Portrait
                    $ResizeFactor=$newWidth / $this->width;
                    $margin=round(($newHeight-($this->height*$ResizeFactor))/2);
                    imagecopyresampled($newImage, $ImageInput, 0,$margin,0 ,0,$this->width*$ResizeFactor,$this->height*$ResizeFactor,$this->width,$this->height);
                }
                else{
                    $ResizeFactor=$newHeight / $this->height;
                    $margin=round(($newWidth-($this->width*$ResizeFactor))/2);
                    imagecopyresampled($newImage, $ImageInput, $margin,0,0 ,0,$this->width*$ResizeFactor,$this->height*$ResizeFactor,$this->width,$this->height);
                }
                break;
            default:
                    imagecopyresampled($newImage, $ImageInput, 0,0,0 ,0,$newWidth,$newHeight,$this->width,$this->height);

        }
        imagejpeg($newImage,$this->filename,99);
        $this->refresh();
    }
    private function refresh(){
        $fileInfo  = getimagesize($this->filename);
        $this->width  = $fileInfo[0];
        $this->height = $fileInfo[1];
        $this->mime = $fileInfo['mime'];
    }
}