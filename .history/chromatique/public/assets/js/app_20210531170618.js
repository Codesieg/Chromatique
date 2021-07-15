// module principal

const app = {
    // on initialise le js 
    init: function() {
        console.log('%c' + 'Methode init executée', 'color: #f0f; font-size: 1rem; background-color:#fff');
        // Ciblage du bouton de fermeture des messages
        let closeElement = document.querySelector(".alert");
        closeElement.addEventListener("DOMContentLoaded", app.closeFlash());

        //ciblage du bouton de zoom in
        let zoomIn = document.querySelector(".zoom-in");
        zoomIn.addEventListener("click", app.zoomIn);

        //ciblage du bouton de zoom out
        let zoomOut = document.querySelector(".zoom-out");
        zoomOut.addEventListener("click", app.zoomOut);


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

    closeFlash: function() {
        const flashElement = document.querySelector(".alert");
        flashElement.classList.add("flash-fade");
        console.log("element " + flashElement);
    },

};
// initialisation du js une fois que toute la apge est chargé
document.addEventListener('DOMContentLoaded', app.init);

console.log('%c' + 'Scrip.js chargé', 'color: #f0f; font-size: 1rem; background-color:#fff');