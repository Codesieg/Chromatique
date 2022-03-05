// module principal

const zoom = {
    // on initialise le js 
    init: function() {
        console.log('%c' + 'Methode zoom executée', 'color: #f0f; font-size: 1rem; background-color:#fff');


        //ciblage du bouton de zoom in
        let zoomIn = document.querySelector(".zoom-in");
        zoomIn.addEventListener("click", zoom.zoomIn);

        //ciblage du bouton de zoom out
        let zoomOut = document.querySelector(".zoom-out");
        zoomOut.addEventListener("click", zoom.zoomOut);


    },

    // fonction pour le zoom in
    zoomIn: function() {
        // on récupére l'élément .page pour lui définir une nouvelle taill
        const pageElementsList = document.querySelectorAll(".page");
        // On cré une boucle afin de récupérer tout les pages d'un tome
        for (let pageElement of pageElementsList) {
            // On récupére la taille actuelle de la page
            const width = pageElement.offsetWidth;
            // On lui ajoute 20px à chaque clique
            pageElement.style.width = (width + 20) + "px";
        }

    },

    zoomOut: function() {
        const pageElementsList = document.querySelectorAll(".page");
        for (let pageElement of pageElementsList) {
            const width = pageElement.offsetWidth;
            pageElement.style.width = (width - 20) + "px";
        }
    },



};
// initialisation du js une fois que toute la page est chargé
document.addEventListener('DOMContentLoaded', zoom.init);

console.log('%c' + 'Scrip.js chargé', 'color: #f0f; font-size: 1rem; background-color:#fff');