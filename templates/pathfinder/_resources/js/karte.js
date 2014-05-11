
function pulse(){
    var savegame;
    $.get('pathfinder.php?site=ajax&action=pulse', function (data) {
        savegame=data.split('|');
        if($('#timestamp').val()!=savegame[0]){
            $('#timestamp').val(savegame[0]);
            $('#timestamp_phase').val(savegame[1]);
            $('#timestamp_turns').val(savegame[2]);
            $('#timestamp_map').val(savegame[4]);
            $('#timestamp_pointers').val(savegame[5]);
            refreshTurn2();
            if($('#userlevel').val()<50) refreshCharinfo();
        }
        else if($('#timestamp_phase').val()!=savegame[1]){
            $('#timestamp_phase').val(savegame[1]);
            refreshPhase();
        }
        else if($('#timestamp_turns').val()!=savegame[2]){
            $('#timestamp_turns').val(savegame[2]);
            refreshTurn2();
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
    setInterval(pulse,3000);
});
