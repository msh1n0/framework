function setEffect(phase,player){
    $('#fullscreenEffect').removeClass('effectDanger');
    $('#fullscreenEffect').removeClass('effectWarning');
    $('#fullscreenEffect').removeClass('effectAttention');
    $('#fullscreenEffect').removeClass('effectInfo');
    if(phase=='Initiativ-Phase'){
        if(player==$('#activeplayer').val())  $('#fullscreenEffect').addClass('effectInfo');
        else $('#fullscreenEffect').addClass('effectWarning');
    }
    else if(phase=='Kampf-Phase'){
        if(player==$('#activeplayer').val())  $('#fullscreenEffect').addClass('effectAttention');
        else $('#fullscreenEffect').addClass('effectDanger');
    }
}
function wuerfeln(modus){
    var value;
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
    $('#btn-w'+modus).addClass('disabled');
    $.get('pathfinder.php?site=ajax&action=setdice&dice=w'+modus+'&value='+value, function (data) {
    });
}
function randomRange (min, max) {
    return Math.round(Math.random() * (max - min) + min);
}
function setPhase(phase){
    $.get('pathfinder.php?site=ajax&action=setphase&value='+phase, function (data) {
    });
}
function setTurn(player){
    $.get('pathfinder.php?site=ajax&action=setturn&value='+player, function (data) {
    });
}
function setTurn2(player){
    $.get('pathfinder.php?site=ajax&action=setturn2&value='+player, function (data) {
    });
}
function setSingleDice(dice,player){
    $.get('pathfinder.php?site=ajax&action=setsingledice&value='+dice+'&user='+player, function (data) {
    });
}
function setCombat(player){
    $.get('pathfinder.php?site=ajax&action=setcombat&value='+player, function (data) {
    });
}
function refreshDice(){
    var savegame;
    $.get('pathfinder.php?site=ajax&action=getdice', function (data) {
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
function refreshContingent(){
    var savegame;
    $.get('pathfinder.php?site=ajax&action=getcontingent', function (data) {
        savegame=data.split('|');
        if(savegame[0]>0) $('#btn-w4').removeClass('disabled');
        else $('#btn-w4').addClass('disabled');
        if(savegame[1]>0) $('#btn-w6').removeClass('disabled');
        else $('#btn-w6').addClass('disabled');
        if(savegame[2]>0) $('#btn-w8').removeClass('disabled');
        else $('#btn-w8').addClass('disabled');
        if(savegame[3]>0) $('#btn-w10').removeClass('disabled');
        else $('#btn-w10').addClass('disabled');
        if(savegame[4]>0) $('#btn-w12').removeClass('disabled');
        else $('#btn-w12').addClass('disabled');
        if(savegame[5]>0) $('#btn-w20').removeClass('disabled');
        else $('#btn-w20').addClass('disabled');
        if(savegame[6]>0) $('#btn-w100').removeClass('disabled');
        else $('#btn-w100').addClass('disabled');

    });
}
function refreshPhase(){
    var savegame;
    $.get('pathfinder.php?site=ajax&action=phase', function (data) {
        savegame=data.split('|');
        $("#currentplayer").val(savegame[0]);
        $("#currentphase").val(savegame[1]);
        $("#playable").val(savegame[2]);
        if(savegame[0]==$("#currentuser").val()) refreshContingent();
        else if($('#userlevel').val()>50){
            if($('#playable').val()=='false') $('.dicebutton').removeClass('disabled');
            else $('.dicebutton').addClass('disabled');
        }
        else $('.dicebutton').addClass('disabled');
        setEffect(savegame[1],savegame[0]);
    });
}
function refreshCharinfo(){
    $('#charinfo').load('pathfinder.php?site=ajax&action=charinfo');
}
function refreshMap(){
    $('#map-container').load('pathfinder.php?site=ajax&action=map');
}
function refreshTurn(){
    $('#turns').load('pathfinder.php?site=ajax&action=turns');
    refreshPhase();
}
function refreshTurn2(){
    $('#turns').load('pathfinder.php?site=ajax&action=turns2');
    refreshPhase();
}
function startInitiative(){
    //Automatische Initiative
    setPhase('Initiative');
}
function mapVisible(player){
    $.get('pathfinder.php?site=ajax&action=mapvisible&value='+player, function (data) {
    });
}
function mapInvisible(player){
    $.get('pathfinder.php?site=ajax&action=mapinvisible&value='+player, function (data) {
    });
}
function setPointer(player, pointerx,pointery){
    $.get('pathfinder.php?site=ajax&action=setpointer&value='+player+'&x='+pointerx+'&y='+pointery, function (data) {
    });
}