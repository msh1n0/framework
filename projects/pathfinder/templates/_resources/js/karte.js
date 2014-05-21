
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
            refreshPhase();
            refreshTurn2();
            refreshMap();
            refreshPointers();
            if($('#userlevel').val()<50) refreshCharinfo();
        }
        if($('#timestamp_phase').val()!=savegame[1]){
            $('#timestamp_phase').val(savegame[1]);
            refreshPhase();
        }
        if($('#timestamp_turns').val()!=savegame[2]){
            $('#timestamp_turns').val(savegame[2]);
            refreshTurn2();
        }
        if($('#timestamp_map').val()!=savegame[4]){
            $('#timestamp_map').val(savegame[4]);
            refreshMap();
        }
        if($('#timestamp_pointers').val()!=savegame[5]){
            $('#timestamp_pointers').val(savegame[5]);
            refreshPointers();
        }
    });
}
$(document).ready(function() {
    pulse();
    setInterval(pulse,500);
});
