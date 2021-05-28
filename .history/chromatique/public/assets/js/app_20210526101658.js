// module principal

const app = {
    let zoomIn = document.querySelector("zoom-in");

    let zoomOut = document.querySelector("zoom-out");
    init: function() {
        console.log('%c' + 'Methode init executée', 'color: #f0f; font-size: 1rem; background-color:#fff');

        //ciblage du bouton de zoom in
        zoomIn.addEventListener("click", app.zoomIn);

        //ciblage du bouton de zoom out
        zoomOut.addEventListener("click", app.zoomOut);

    },

    zoomIn: function() {
        let zoom = document.querySelector("zoom");
        var width = content.offsetWidth
        zoom.style.width = (width + 5) + "%";
    },

    zoomOut: function() {
        let zoom = document.querySelector("zoom");
        var width = content.offsetWidth
        zoom.style.width = (width - 5) + "%";
    },

};

document.addEventListener('DOMContentLoaded', app.init);

console.log('%c' + 'Scrip.js chargé', 'color: #f0f; font-size: 1rem; background-color:#fff');