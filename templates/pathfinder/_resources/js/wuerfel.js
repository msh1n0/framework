$("#btn-w4").click(function(){wuerfeln(4);});
$("#btn-w6").click(function(){wuerfeln(6);});
$("#btn-w8").click(function(){wuerfeln(8);});
$("#btn-w10").click(function(){wuerfeln(10);});
$("#btn-w12").click(function(){wuerfeln(12);});
$("#btn-w20").click(function(){wuerfeln(20);});
$("#btn-w100").click(function(){wuerfeln(100);});
$("#btn-skip").click(function(){
    $.get('index.php?action=turn', function (data) {
    });
    checkRound();
});
$("#btn-clean-all").click(function(){
    flush();
    flushDice()
});
function wuerfeln(modus){
    var value;
    var slot;
    switch(modus){
        case 4:
            value=randomRange(1,4);
            break;
        case 6:
            value=randomRange(1,6);
            break;
        case 8:
            value=randomRange(1,8);
            break;
        case 10:
            value=(randomRange(1,10)-1);
            break;
        case 12:
            value=randomRange(1,12);
            break;
        case 20:
            value=randomRange(1,20);
            break;
        case 100:
            value=(randomRange(1,10)*10);
            break;
    }
    disableButtons();
    setValue(modus,value);
    setDice(modus,$('#w'+modus).val());
    checkRound();
}
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
function setTurn(player){
    flush();
    flushDice();
    $.get('index.php?action=turn&player='+player, function (data) {
    });
    checkRound();
}
function enableButtons(){
    $('input[type="button"]').removeClass('disabled');
}
function enable(id){
    $('#btn-'+id).removeClass('disabled');
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
function getTurn(){
    var savegame;
    $.get('pathfinder.php?site=wuerfel&action=getturn', function (data) {
        savegame=data.split('|');
        $("#currentplayer").val(savegame[0]);
        $("#contingent-w4").val(savegame[1]);
        $("#contingent-w6").val(savegame[2]);
        $("#contingent-w8").val(savegame[3]);
        $("#contingent-w10").val(savegame[4]);
        $("#contingent-w12").val(savegame[5]);
        $("#contingent-w20").val(savegame[6]);
        $("#contingent-w100").val(savegame[7]);
    });
}
function setDice(slot,wert){
    $.get('pathfinder.php?site=wuerfel&action=setdice&slot='+slot+'&value='+wert, function (data) {
    });
}function flushDice(){
    $.get('pathfinder.php?site=wuerfel&action=flushdice', function (data) {
    });
}
function checkRound(){
    getDice();
    getTurn();
    disableButtons();
    if($('#contingent-w4').val()>0) enable('w4');
    if($('#contingent-w6').val()>0) enable('w6');
    if($('#contingent-w8').val()>0) enable('w8');
    if($('#contingent-w10').val()>0) enable('w10');
    if($('#contingent-w12').val()>0) enable('w12');
    if($('#contingent-w20').val()>0) enable('w20');
    if($('#contingent-w100').val()>0) enable('w100');

}
$(document).ready(function() {
    checkRound();
    setInterval(checkRound,500);
});
