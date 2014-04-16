function shadowGrow(){
    $('#test').boxShadow()
    //setTimeout(shadowShrink(),200);
}
function shadowShrink(){
    //$('#test').css('boxs-shadow:inset 0 0 50px #f00').animate();
}
$(document).ready(function() {
    //setInterval(shadowGrow(),1000);
    shadowGrow();
});
