// module principal

const app = {

    init: function() {
        console.log('%c' + 'Methode init executée', 'color: #f0f; font-size: 1rem; background-color:#fff');

        //ciblage du bouton de zoom in
        document.addEventListener("click", function() {
            document.getElementById("zoom-in");
        });


    }
};

document.addEventListener('DOMContentLoaded', app.init);

console.log('%c' + 'Scrip.js chargé', 'color: #f0f; font-size: 1rem; background-color:#fff');