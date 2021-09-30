const app = {

    closeFlash: function() {

        // Ciblage du bouton de fermeture des message
        document.addEventListener("DOMContentLoaded", app.closeFlash());

        const flashElement = document.querySelector(".alert");
        flashElement.classList.add("flash-fade");
    },

}