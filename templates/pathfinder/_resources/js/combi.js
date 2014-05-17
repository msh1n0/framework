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
            refreshTurn2();
            refreshDice();
            if($('#userlevel').val()<50) refreshCharinfo();
            refreshPointers();
            refreshMap();
        }
        else if($('#timestamp_phase').val()!=savegame[1]){
            $('#timestamp_phase').val(savegame[1]);
            refreshPhase();
        }
        else if($('#timestamp_turns').val()!=savegame[2]){
            $('#timestamp_turns').val(savegame[2]);
            refreshTurn();
            refreshTurn2();
        }
        else if($('#timestamp_dice').val()!=savegame[3]){
            $('#timestamp_dice').val(savegame[3]);
            refreshDice();
        }
        else if($('#timestamp_map').val()!=savegame[4]){
            $('#timestamp_map').val(savegame[4]);
            refreshMap();
        }
        else if($('#timestamp_pointers').val()!=savegame[5]){
            $('#timestamp_pointers').val(savegame[5]);
            refreshPointers();
        }
    });
}
function activateBox(newbox){
    if($('#status_box1').val()=='active') currentbox=1;
    if($('#status_box2').val()=='active') currentbox=2;
    if($('#status_box3').val()=='active') currentbox=3;
    newbox_position=$('#status_box'+newbox).val();
    $('#status_box'+newbox).val('active');
    $('#status_box'+currentbox).val(newbox_position);

    for(i=1;i<=3;i++){
        $('.content-box'+i).removeClass('shift_active');
        $('.content-box'+i).removeClass('shift_left');
        $('.content-box'+i).removeClass('shift_right');
        $('.content-box'+i).addClass('shift_'+$('#status_box'+i).val());
    }
}
$(document).ready(function() {
    pulse();
    setInterval(pulse,500);
});
