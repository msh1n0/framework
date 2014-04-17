<?php

function getCurrentPlayer(){
    $datei = file('data/save.db');
    $output='';
    foreach($datei AS $ausgabe){
        $part = explode("|", $ausgabe);
        $output=$part[0];
    }
    return $output;
}
function logIn($login){
    $success=false;
    switch($login){
        case "mlfm21":
            $_SESSION['status']='1';
            $_SESSION['username']='Sumomo';
            $success=true;
    }
    switch($login){
        case "Nintendo151":
            $_SESSION['status']='2';
            $_SESSION['username']='Spielleiter';
            $success=true;
    }
    switch($login){
        case "Seem":
            $_SESSION['status']='1';
            $_SESSION['username']='Seemless';
            $success=true;
    }
    switch($login){
        case "Öde":
            $_SESSION['status']='1';
            $_SESSION['username']='Öde';
            $success=true;
    }
    switch($login){
        case "Tabtab":
            $_SESSION['status']='1';
            $_SESSION['username']='Lars';
            $success=true;
    }
    switch($login){
        case "Chris":
            $_SESSION['status']='1';
            $_SESSION['username']='Chris';
            $success=true;
    }
    switch($login){
        case "Nora":
            $_SESSION['status']='1';
            $_SESSION['username']='Norahna';
            $success=true;
    }
    switch($login){
        case "Tesi":
            $_SESSION['status']='1';
            $_SESSION['username']='Tesius';
            $success=true;
    }
    switch($login){
        case "Marcus":
            $_SESSION['status']='1';
            $_SESSION['username']='Marcus';
            $success=true;
    }
    switch($login){
        case "Asmo":
            $_SESSION['status']='1';
            $_SESSION['username']='Asmodina';
            $success=true;
    }
    if($success==true){
        $dateihandle = fopen('data/users/'.$_SESSION['username'].'.db','w');
        fwrite($dateihandle,'');
        fclose($dateihandle);
    }
}
function getSavegame(){
    $datei = file('data/save.db');
    $output='';
    foreach($datei AS $ausgabe){
        $output=$ausgabe;
    }
    return $output;
}
function getUserlist(){
    $handle=opendir ("data/users");
    $output='';
    while ($datei = readdir ($handle)) {
        if($datei!=='.' && $datei!=='..'){
            $datei=str_replace('.db','', $datei);
            $output.='<p>'.$datei.' - <a href="#" onclick="setTurn(\''.$datei.'\')">Würfel geben</a></p>';
        }
    }
    $output .= '<a href="#" onclick="setTurn(\'Spielleiter\')">Würfel nehmen</a>';
    closedir($handle);
    return $output;
}
function setSavegame($slot,$wert){
    $output='';
    $originalsave=file('data/save.db');
    $savegame=explode('|',$originalsave[0]);
    $newsavegame[0]=$savegame[0];
    $newsavegame[1]=$savegame[1];
    $newsavegame[2]=$savegame[2];
    $newsavegame[3]=$savegame[3];
    $newsavegame[4]=$savegame[4];
    $newsavegame[5]=$savegame[5];
    $newsavegame[6]=$savegame[6];
    $newsavegame[7]=$savegame[7];
    $newsavegame[$slot]=$wert;


    foreach($newsavegame as $element){
        $output.=$element.'|';
    }
    $dateihandle = fopen('data/save.db','w');
    fwrite($dateihandle,$output);
    fclose($dateihandle);
}
function flushSavegame(){
    $output='';
    $newsavegame[0]='Spielleiter';
    $newsavegame[1]='';
    $newsavegame[2]='';
    $newsavegame[3]='';
    $newsavegame[4]='';
    $newsavegame[5]='';
    $newsavegame[6]='';
    $newsavegame[7]='';


    foreach($newsavegame as $element){
        $output.=$element.'|';
    }
    $dateihandle = fopen('data/save.db','w');
    fwrite($dateihandle,$output);
    fclose($dateihandle);
}
function setTurn($player){
    if($player=='') $player='Spielleiter';
    $output='';
    $originalsave=file('data/save.db');
    $savegame=explode('|',$originalsave[0]);
$savegame[0]=$player;

    foreach($savegame as $element){
        $output.=$element.'|';
    }
    $dateihandle = fopen('data/save.db','w');
    fwrite($dateihandle,$output);
    fclose($dateihandle);
}