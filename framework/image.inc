<?php

/**
 * Class image
 * TODO: Wasserzeichen, Rahmen, Texte, Verarbeitung in Datei ablegen beim Resize
 */
class image{
    private $filename;

    public function setFile($filename){
        $this->filename=$filename;
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
        $fileInfo  = getimagesize($this->filename);
        $OriginalWidth  = $fileInfo[0];
        $OriginalHeight = $fileInfo[1];

        $newImage = imagecreatetruecolor($newWidth,$newHeight);
        imagefill($newImage, 0, 0, imagecolorallocate($newImage,$rgb[0],$rgb[1],$rgb[2]));

        if(!touch($this->filename)) throw(new ErrorException('Zugriff auf die Datei wurde verweigert'));
        if($fileInfo['mime']=='image/jpeg') $ImageInput = imagecreatefromjpeg($this->filename);
        elseif($fileInfo['mime']=='image/png') $ImageInput = imagecreatefrompng($this->filename);
        else throw(new BadMethodCallException('Dateiformat nicht unterstützt'));

        switch($mode){
            case 'touch-inner':
                if ($OriginalHeight>$OriginalWidth){  //Portrait
                    $ResizeFactor=$newHeight / $OriginalHeight;
                    $margin=round(($newWidth-($OriginalWidth*$ResizeFactor))/2);
                    imagecopyresampled($newImage, $ImageInput, $margin,0,0 ,0,$OriginalWidth*$ResizeFactor,$OriginalHeight*$ResizeFactor,$OriginalWidth,$OriginalHeight);

                }
                else{
                    $ResizeFactor=$newWidth / $OriginalWidth;
                    $margin=round(($newHeight-($OriginalHeight*$ResizeFactor))/2);
                    imagecopyresampled($newImage, $ImageInput, 0,$margin,0 ,0,$OriginalWidth*$ResizeFactor,$OriginalHeight*$ResizeFactor,$OriginalWidth,$OriginalHeight);
                }
                break;
            case 'touch-outer':
                if ($OriginalHeight>$OriginalWidth){  //Portrait
                    $ResizeFactor=$newWidth / $OriginalWidth;
                    $margin=round(($newHeight-($OriginalHeight*$ResizeFactor))/2);
                    imagecopyresampled($newImage, $ImageInput, 0,$margin,0 ,0,$OriginalWidth*$ResizeFactor,$OriginalHeight*$ResizeFactor,$OriginalWidth,$OriginalHeight);
                }
                else{
                    $ResizeFactor=$newHeight / $OriginalHeight;
                    $margin=round(($newWidth-($OriginalWidth*$ResizeFactor))/2);
                    imagecopyresampled($newImage, $ImageInput, $margin,0,0 ,0,$OriginalWidth*$ResizeFactor,$OriginalHeight*$ResizeFactor,$OriginalWidth,$OriginalHeight);
                }
                break;
            default:
                    imagecopyresampled($newImage, $ImageInput, 0,0,0 ,0,$newWidth,$newHeight,$OriginalWidth,$OriginalHeight);

        }
        return $newImage;
    }
}