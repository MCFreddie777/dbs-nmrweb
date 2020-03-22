require('./bootstrap');


$(window).on('load', function () {

    // Remove alert after clicking close
    const alert = document.querySelector('#alert');
    const closeBtn = document.querySelector('.close-btn');

    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            setTimeout(() => {
                alert.remove();
            }, 250);
        });
    }

    // JSApplet for chemical structures
    setTimeout(function () {
        window.jsmeApplet = new JSApplet.JSME("jsme", {
            options: "newlook"
        });
    }, 750);
});
