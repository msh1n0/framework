var slider = new Swipe(document.getElementById('slider'), {callback: function (e, pos) {
    var i = bullets.length;
    while (i--) {
        bullets[i].className = ' ';
    }
    bullets[pos].className = 'on';
}}), bullets = document.getElementById('position').getElementsByTagName('em');
for (var i = 0; i < selectors.length; i++) {
    var elem = selectors[i];
    elem.setAttribute('data-tab', i);
    elem.onclick = function (e) {
        e.preventDefault();
        setTab(this);
        tabs.slide(parseInt(this.getAttribute('data-tab'), 10), 300);
    }
}
function setTab(elem) {
    for (var i = 0; i < selectors.length; i++) {
        selectors[i].className = selectors[i].className.replace('on', ' ');
    }
    elem.className += ' on';
}
(function () {
    var win = window, doc = win.document;
    if (!location.hash || !win.addEventListener) {
        window.scrollTo(0, 1);
        var scrollTop = 1, bodycheck = setInterval(function () {
            if (doc.body) {
                clearInterval(bodycheck);
                scrollTop = "scrollTop" in doc.body ? doc.body.scrollTop : 1;
                win.scrollTo(0, scrollTop === 1 ? 0 : 1);
            }
        }, 15);
        if (win.addEventListener) {
            win.addEventListener("load", function () {
                setTimeout(function () {
                    win.scrollTo(0, scrollTop === 1 ? 0 : 1);
                }, 0);
            }, false);
        }
    }
})();