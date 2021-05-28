// module principal

const app = {
    // on initialise le js 
    init: function() {
        console.log('%c' + 'Methode init executée', 'color: #f0f; font-size: 1rem; background-color:#fff');

        //ciblage du bouton de zoom in
        let zoomIn = document.querySelector(".zoom-in");
        zoomIn.addEventListener("click", app.zoomIn);

        //ciblage du bouton de zoom out
        let zoomOut = document.querySelector(".zoom-out");
        zoomOut.addEventListener("click", app.zoomOut);

    },

    // fonction pour le zoom in
    zoomIn: function() {
        // on récupére l'élément .scale pour lui définir une nouvelle taill
        const scaleElementsList = document.querySelectorAll(".scale");
        // On cré une boucle afin de récupérer tout les pages d'un tome
        for (let scaleElement of scaleElementsList) {
            // On récupére la taille actuelle de la page
            const width = scaleElement.offsetWidth;
            // On lui ajoute 20px à chaque clique
            scaleElement.style.width = (width + 20) + "px";
        }

    },

    zoomOut: function() {
        const scaleElementsList = document.querySelectorAll(".scale");
        for (let scaleElement of scaleElementsList) {
            const width = scaleElement.offsetWidth;
            scaleElement.style.width = (width - 20) + "px";
        }
    },

};
// initialisation du js une fois que toute la apge est chargé
document.addEventListener('DOMContentLoaded', app.init);

console.log('%c' + 'Scrip.js chargé', 'color: #f0f; font-size: 1rem; background-color:#fff');