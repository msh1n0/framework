<?php
session_start();

error_reporting(0);
    include "php/functions.php";

if(isset($_GET['action'])){
    switch ($_GET['action']){
        case 'logout':
            session_destroy();
            header("Location:index.php");
            break;
        case 'login':
            logIn($_POST['login']);
            header("Location:index.php");
            break;
        case 'getsavegame':
            echo getSavegame();
            exit;
        case 'setsavegame':
            setSavegame($_GET['slot'], $_GET['wert']);
            exit;
        case 'flushsavegame':
            flushSavegame();
            exit;
        case 'turn':
            setTurn($_GET['player']);
            break;
        case 'getuserlist':
            echo getUserlist();
            exit;
    }
}

echo'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//DE">
<html>
<head>
    <link rel="icon" href="http://en.tera.gameforge.com/favicon.ico" type="image/ico">
    <link rel="shortcut icon" type="image/x-icon" href="http://en.tera.gameforge.com/favicon.ico">
    <link rel="favicon" href="http://en.tera.gameforge.com/favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta http-equiv="content-language" content="de">
    <meta name="author" content="Marco Soschniok">
    <meta name="audience" content="Alle">
    <meta name="publisher" content="Marco Soschniok">
    <meta name="copyright" content="Marco Soschniok">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>Würfeln als '.$_SESSION['username'].'</title>
    <link rel="stylesheet" href="css/bootstrap-theme.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<input type="hidden" value="'.getCurrentPlayer().'" name="active-player" id="active-player">
<input type="hidden" value="'.$_SESSION['username'].'" name="username" id="username">
<input type="hidden" value="'.$_SESSION['status'].'" name="status" id="status">

<div class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6">';

                if(isset($_SESSION['status'])){
                    echo '
                    <div class="alert alert-info text-center">
                    <p>du spielst als '.$_SESSION['username'].'. <a href="index.php?action=logout">abmelden</a></p>
                </div>
                    ';
                }
                else {
                    echo '
                <div class="alert alert-danger text-center">
                    <p>anmelden</p>
                    <form action="index.php?action=login" method="post">
                        <input type="password" name="login" class="form-control">
                    </form>
                </div>
                    ';
                }
if($_SESSION['status']==2){
    echo '<div class="alert alert-danger text-center"><p>';
    echo '<span id="current-player"></span>ist an der Reihe';
    echo '</p></div>';
    echo '<div class="alert alert-success" id="userliste">'.getUserlist().'</div>';
}
else{
    echo '<div class="alert alert-danger text-center"><h4>';
    echo '<span id="current-player"></span>ist an der Reihe';
    echo '</h4></div>';
}
echo'
            </div>
            <div class="col-lg-3">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6">
            ';


echo'
            </div>
            <div class="col-lg-3">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-3">
                <input type="button" class="form-control btn btn-default btn-block disabled" value="1W4" id="btn-w4">
            </div>
            <div class="col-lg-3">
                <div class="form-group has-feedback" id="group-w4">
                    <input type="text" class="form-control" value="" id="w4" disabled="disabled">
                </div>
            </div>
            <div class="col-lg-3">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-3">
                <input type="button" class="form-control btn btn-info btn-block disabled" value="1W6" id="btn-w6">
            </div>
            <div class="col-lg-3">
                <div class="form-group has-feedback" id="group-w6">
                    <input type="text" class="form-control" value="" id="w6" disabled="disabled">
                </div>
            </div>
            <div class="col-lg-3">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-3">
                <input type="button" class="form-control btn btn-info btn-block disabled" value="1W8" id="btn-w8">
            </div>
            <div class="col-lg-3">
                <div class="form-group has-feedback" id="group-w8">
                    <input type="text" class="form-control" value="" id="w8" disabled="disabled">
                </div>
            </div>
            <div class="col-lg-3">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-3">
                <input type="button" class="form-control btn btn-warning btn-block disabled" value="1W10" id="btn-w10">
            </div>
            <div class="col-lg-3">
                <div class="form-group has-feedback" id="group-w10">
                    <input type="text" class="form-control" value="" id="w10" disabled="disabled">
                </div>
            </div>
            <div class="col-lg-3">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-3">
                <input type="button" class="form-control btn btn-warning btn-block disabled" value="1W12" id="btn-w12">
            </div>
            <div class="col-lg-3">
                <div class="form-group has-feedback" id="group-w12">
                    <input type="text" class="form-control" value="" id="w12" disabled="disabled">
                </div>
            </div>
            <div class="col-lg-3">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-3">
                <input type="button" class="form-control btn btn-success btn-block disabled" value="1W20" id="btn-w20">
            </div>
            <div class="col-lg-3">
                <div class="form-group has-feedback" id="group-w20">
                    <input type="text" class="form-control" value="" id="w20" disabled="disabled">
                </div>
            </div>
            <div class="col-lg-3">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-3">
                <input type="button" class="form-control btn btn-success btn-block disabled" value="1W100" id="btn-w100">
            </div>
            <div class="col-lg-3">
                <div class="form-group has-feedback" id="group-w100">
                    <input type="text" class="form-control" value="" id="w100" disabled="disabled">
                </div>
            </div>
            <div class="col-lg-3">
            </div>
        </div>';
if($_SESSION['status']==2) echo'
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6">
                <input type="button" class="form-control btn btn-danger btn-block disabled" value="Alle Felder löschen" id="btn-clean-all">
            </div>
            <div class="col-lg-3">
            </div>
        </div>';
elseif($_SESSION['status']==1) echo'
    <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6">
                <input type="button" class="form-control btn btn-danger btn-block disabled" value="Würfel ablegen" id="btn-skip">
            </div>
            <div class="col-lg-3">
            </div>
        </div>';
echo'
    </div>
</div>
<script src="js/custom.js" type="text/javascript"></script>
</body>
</html>';