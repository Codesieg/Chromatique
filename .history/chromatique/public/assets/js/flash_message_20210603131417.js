const app = {

    closeFlash: function() {

        // Ciblage du bouton de fermeture des message
        document.addEventListener("DOMContentLoaded", app.closeFlash());

        const flashElement = document.querySelector(".alert");
        flashElement.classList.add("flash-fade");
    },

};

// initialisation du js une fois que toute la apge est chargé
document.addEventListener('DOMContentLoaded', app.init);

console.log('%c' + 'Scrip.js chargé', 'color: #f0f; font-size: 1rem; background-color:#fff');