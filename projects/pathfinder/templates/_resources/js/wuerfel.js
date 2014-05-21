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
            refreshPhase();
            refreshTurn();
            refreshDice();
            if($('#userlevel').val()<50) refreshCharinfo();
        }
        if($('#timestamp_phase').val()!=savegame[1]){
            $('#timestamp_phase').val(savegame[1]);
            refreshPhase();
        }
        if($('#timestamp_turns').val()!=savegame[2]){
            $('#timestamp_turns').val(savegame[2]);
            refreshTurn();
        }
        if($('#timestamp_dice').val()!=savegame[3]){
            $('#timestamp_dice').val(savegame[3]);
            refreshDice();
        }
    });
}
$(document).ready(function() {
    pulse();
    setInterval(pulse,500);
});
