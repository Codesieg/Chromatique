// module principal

const app = {

    init: function() {
        console.log('%c' + 'Methode init executée', 'color: #f0f; font-size: 1rem; background-color:#fff');

        //ciblage du bouton de zoom in
        let zoomIn = document.querySelector("zoom-in");
        let zoom = document.querySelector("zoom");

        zoomIn.addEventListener("click", app.zoomIn);


        zoomIn: function() {
            var width = content.offsetWidth
            zoom.style.width = (width + 5) + "%";
        };

    }
};

document.addEventListener('DOMContentLoaded', app.init);

console.log('%c' + 'Scrip.js chargé', 'color: #f0f; font-size: 1rem; background-color:#fff');