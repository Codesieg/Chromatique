// module principal

const app = {

    init: function() {
        console.log('%c' + 'Methode init executée', 'color: #f0f; font-size: 1rem; background-color:#fff');

        //ciblage du bouton de zoom in
        let zoomIn = document.querySelector(".zoom-in");
        zoomIn.addEventListener("click", app.zoomIn);

        //ciblage du bouton de zoom out
        let zoomOut = document.querySelector(".zoom-out");
        zoomOut.addEventListener("click", app.zoomOut);

    },

    zoomIn: function() {
        let scale = document.querySelector(".scale");
        let width = scale.offsetWidth;
        console.log(width);
        scale.style.width = (width + 5) + "%";
    },

    zoomOut: function() {
        let scale = document.querySelector(".scale");
        let width = scale.offsetWidth;
        console.log(width);
        scale.style.width = (width - 5) + "%";
    },

};

document.addEventListener('DOMContentLoaded', app.init);

console.log('%c' + 'Scrip.js chargé', 'color: #f0f; font-size: 1rem; background-color:#fff');