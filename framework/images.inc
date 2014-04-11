<?php

/**
 * Class imageController Bildverarbeitungfunktionen
 * @author  Marco Soschniok
 * @function resampleImage Bildgröße ändern
 * TODO: Wasserzeichen, Rahmen, Texte
 */
class images{
    /**
     * @param string $filename Pfad zur Datei
     * @param int $newWidth Zielbreite des Bildes
     * @param int $newHeight Zielhöhe des Bildes
     * @param string $mode touch-inner, touch-outer oder leer
     * @param array $rgb RGB-Code in Arrayform
     * @return Resource-Object
     * @throws ErrorException
     * @throws BadMethodCallException
     * */
    static function resampleImage($filename, $newWidth, $newHeight, $mode, array $rgb){
        $fileInfo  = getimagesize($filename);
        var_dump($fileInfo);
        $OriginalWidth  = $fileInfo[0];
        $OriginalHeight = $fileInfo[1];

        $newImage = imagecreatetruecolor($newWidth,$newHeight);
        imagefill($newImage, 0, 0, imagecolorallocate($newImage,$rgb[0],$rgb[1],$rgb[2]));

        if(!touch($filename)) throw(new ErrorException('Zugriff auf die Datei wurde verweigert'));
        if($fileInfo['mime']=='image/jpeg') $ImageInput = imagecreatefromjpeg($filename);
        elseif($fileInfo['mime']=='image/png') $ImageInput = imagecreatefrompng($filename);
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