
/*
$("#btn-clean-all").click(function(){
    flush();
    flushDice()
});

function randomRange (min, max) {
    return Math.round(Math.random() * (max - min) + min);
}
function setValue(modus, value){
    if($("#w"+modus).val()=='')$("#w"+modus).val(value);
    else $("#w"+modus).val($("#w"+modus).val()+','+value);
}
function flush(){
    $('input[type="text"]').val('');
}
function setphase(phase){
    $.get('pathfinder.php?site=wuerfel&action=setphase&phase='+phase, function (data) {
    });
}
function enableButtons(){
    $('input[type="button"]').removeClass('disabled');
}
function enable(id){
    $('#btn-'+id).removeClass('disabled');
}
function disable(id){
    $('#btn-'+id).addClass('disabled');
}
function disableButtons(){
    $('input[type="button"]').addClass('disabled');
}
function getDice(){
    var savegame;
    $.get('pathfinder.php?site=wuerfel&action=getdice', function (data) {
        savegame=data.split('|');
        $("#w4").val(savegame[0]);
        $("#w6").val(savegame[1]);
        $("#w8").val(savegame[2]);
        $("#w10").val(savegame[3]);
        $("#w12").val(savegame[4]);
        $("#w20").val(savegame[5]);
        $("#w100").val(savegame[6]);
    });
}
function setTurn(user){
    $('input[type="checkbox"]').prop('checked', false);
    $.get('pathfinder.php?site=wuerfel&action=setturn&user='+user+'&confirm=true&js=true', function (data) {
    });
}
function getTurn(){
    var savegame;
    $.get('pathfinder.php?site=wuerfel&action=getturn', function (data) {
        savegame=data.split('|');
        $("#currentplayer").val(savegame[0]);
        $('input[type="checkbox"]').prop('checked', false);
        $("#status-"+savegame[0]).prop('checked', true);
        $("#currentplayer_headline").val(savegame[0]);
        $("#currentphase").val(savegame[8]);
        setEffect(savegame[8],savegame[0]);
        if(savegame[0]==$('#activeplayer').val()){
            if(savegame[1]>0) enable('w4');
            else disable('w4');
            if(savegame[2]>0) enable('w6');
            else disable('w6');
            if(savegame[3]>0) enable('w8');
            else disable('w8');
            if(savegame[4]>0) enable('w10');
            else disable('w10');
            if(savegame[5]>0) enable('w12');
            else disable('w12');
            if(savegame[6]>0) enable('w20');
            else disable('w20');
            if(savegame[7]>0) enable('w100');
            else disable('w100');
        }
        else{
            disableButtons();
        }
    });
}
function setDice(slot,wert){
    $.get('pathfinder.php?site=wuerfel&action=setdice&slot='+slot+'&value='+wert, function (data) {
    });
}function flushDice(){
    $.get('pathfinder.php?site=wuerfel&action=flushdice', function (data) {
    });
}

*/
//###################################################################

$("#btn-w4").click(function(){wuerfeln(4);});
$("#btn-w6").click(function(){wuerfeln(6);});
$("#btn-w8").click(function(){wuerfeln(8);});
$("#btn-w10").click(function(){wuerfeln(10);});
$("#btn-w12").click(function(){wuerfeln(12);});
$("#btn-w20").click(function(){wuerfeln(20);});
$("#btn-w100").click(function(){wuerfeln(100);});

function pulse(){
    var savegame;
    $.get('pathfinder.php?site=ajax&action=pulse', function (data) {
        savegame=data.split('|');
        if($('#timestamp').val()!=savegame[0]){
            $('#timestamp').val(savegame[0]);
            $('#timestamp_phase').val(savegame[1]);
            $('#timestamp_turns').val(savegame[2]);
            $('#timestamp_dice').val(savegame[3]);
            $('#timestamp_map').val(savegame[4]);
            refreshTurn();
            refreshDice();
            if($('#userlevel').val()<50) refreshCharinfo();
        }
        else if($('#timestamp_phase').val()!=savegame[1]){
            $('#timestamp_phase').val(savegame[1]);
            refreshPhase();
        }
        else if($('#timestamp_turns').val()!=savegame[2]){
            $('#timestamp_turns').val(savegame[2]);
            refreshTurn();
        }
        else if($('#timestamp_dice').val()!=savegame[3]){
            $('#timestamp_dice').val(savegame[3]);
            refreshDice();
        }
        else if($('#timestamp_map').val()!=savegame[4]){
            $('#timestamp_map').val(savegame[4]);
            //refreshMap();
        }
    });
}
$(document).ready(function() {
    pulse();
    setInterval(pulse,500);
});