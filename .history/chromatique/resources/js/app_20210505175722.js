require('./bootstrap');

// ciblage du nom de l'image
let taskNameElement = taskElement.querySelector('.task__name-display');
taskNameElement.addEventListener('click', task.handleClickOnTaskName);

// On démarrage  de l'application on ajoute un event sur la div des images pour gérer le zoom