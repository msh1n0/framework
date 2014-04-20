$(".cell").click(function(){
    input=this.id;
    position=input.split('_');
    setPointer($('#name').val(),position[1],position[2],$('#color').val())
});
$("#btn-deletemarker").click(function(){
    deletePointer($('#name').val());
});
$("#btn-deleteallmarkers").click(function(){
    $.get('pathfinder.php?site=karte&action=flushpointers', function (data) {
    });
});
function refreshPointers(){
    $('#styleblock').load('pathfinder.php?site=karte&action=getpointers');
}
function setPointer(name,col,rows,color){
    if($('#isadmin').val()==1){
        $.get('pathfinder.php?site=karte&action=setpointer&name='+name+'&col='+col+'&row='+rows+'&color='+color+'&mode=admin', function (data) {
        });
    }
    else if($('#currentplayer_headline').val()==$('#activeplayer').val()){
        $.get('pathfinder.php?site=karte&action=setpointer&name=Ziel&col='+col+'&row='+rows+'&color=xxx', function (data) {
        });
    }
}
function deletePointer(name){
    $.get('pathfinder.php?site=karte&action=deletepointer&name='+name, function (data) {
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
        if($('#currentplayer_headline').val()==$('#activeplayer').val()){

        }
    });
}
function refreshAll(){
    refreshPointers();
    getTurn();
}
$(document).ready(function() {
    refreshAll();
    setInterval(refreshAll,500);
});
