$("#btn-w4").click(function(){wuerfeln(4);cleanUp();});
$("#btn-w6").click(function(){wuerfeln(6);cleanUp();});
$("#btn-w8").click(function(){wuerfeln(8);cleanUp();});
$("#btn-w10").click(function(){wuerfeln(10);cleanUp();});
$("#btn-w12").click(function(){wuerfeln(12);cleanUp();});
$("#btn-w20").click(function(){wuerfeln(20);cleanUp();});
$("#btn-w100").click(function(){wuerfeln(100);cleanUp();});
$("#btn-skip").click(function(){
    $.get('index.php?action=turn', function (data) {
    });
    checkRound();
});
$("#btn-clean-all").click(function(){
    flush();
    flushSavegame()
});
function wuerfeln(modus){
    var value;
    var slot;
    switch(modus){
        case 4:
            slot=1;
            value=randomRange(1,4);
            break;
        case 6:
            slot=2;
            value=randomRange(1,6);
            break;
        case 8:
            slot=3;
            value=randomRange(1,8);
            break;
        case 10:
            slot=4;
            value=(randomRange(1,10)-1);
            break;
        case 12:
            slot=5;
            value=randomRange(1,12);
            break;
        case 20:
            slot=6;
            value=randomRange(1,20);
            break;
        case 100:
            slot=7;
            value=(randomRange(1,10)*10);
            break;
    }
    cleanInputs();
    setValue(modus,value);
    activateInput(modus);
    setSavegame(slot,$('#w'+modus).val());
}
function activateInput(modus){
    $("#group-w"+modus).addClass('has-success');
}
function cleanInputs(){
    $(".form-group").removeClass('has-success');
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
    flushSavegame();
    $.get('index.php?action=turn&player='+player, function (data) {
    });
    checkRound();
}
function allSuccess(){
    $(".form-group").addClass('has-success');
}
function cleanUp(){
    setTimeout(cleanInputs, 3000);
}
function enableButtons(){
    $('input[type="button"]').removeClass('disabled');
}
function disableButtons(){
    $('input[type="button"]').addClass('disabled');
}
function getSavegame(){
    var savegame;
    $.get('index.php?action=getsavegame', function (data) {
        savegame=data.split('|');
        $("#active-player").val(savegame[0]);
        if($('#username').val()==savegame[0]){
            $("#current-player").text('Du b');
            enableButtons();
        }
        else {
            $("#current-player").text(savegame[0]+' ');
        }

        $("#w4").val(savegame[1]);
        $("#w6").val(savegame[2]);
        $("#w8").val(savegame[3]);
        $("#w10").val(savegame[4]);
        $("#w12").val(savegame[5]);
        $("#w20").val(savegame[6]);
        $("#w100").val(savegame[7]);
    });
}
function setSavegame(slot,wert){
    $.get('index.php?action=setsavegame&slot='+slot+'&wert='+wert, function (data) {
    });
}function flushSavegame(){
    $.get('index.php?action=flushsavegame', function (data) {
    });
}
function checkRound(){
    getSavegame();
    if($('#username').val()==$('#active-player').val() || $('#status').val()==2)enableButtons();
    else disableButtons();
}
$(document).ready(function() {
    getSavegame();
    checkRound();
    setInterval(checkRound,500);
});
