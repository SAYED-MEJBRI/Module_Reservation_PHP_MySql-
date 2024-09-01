// Sélectionne tous les éléments avec la classe "calendar-box" et les stocke dans la variable selectHours
const selectHours = document.querySelectorAll(".calendar-box");

// Parcourt chaque élément selectHours
selectHours.forEach((element) => {
    // Ajoute un écouteur d'événement "click" à chaque élément
    element.addEventListener("click", (e) => {
        // Ajoute ou supprime la classe "active" de l'élément courant
        e.currentTarget.classList.toggle("active");

        // Sélectionne l'élément <input> à l'intérieur de l'élément courant
        const input = e.currentTarget.querySelector("input");

        // Vérifie si l'élément <input> a été trouvé
        if (input !== null) {
            // Inverse la valeur de la propriété "checked" de l'élément <input>
            input.checked = !input.checked;
        }
    });
});



