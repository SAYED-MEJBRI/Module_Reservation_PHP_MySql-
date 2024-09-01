
<footer class="  ">
  <div class="mw-1320 m-auto my-3">
    <div class="d-flex fw-wrap g-1 jc-se  ">
      <div class="p-2 my-1 ">
      <h3><strong>Espace Shambaya</strong></h3>
      <div class="p-1 text-center my-3">
                <a class="btn p-1" href="#"> <img class="icon" src="assets/img/img_site/facebook.svg" alt="icon_fcb" width="30"></i></a>
                <a class="btn p-1" href="#"> <img class="icon" src="assets/img/img_site/youtube.svg" alt="icon_youtube" width="30"></i></a>
                <a class="btn p-1" href="#"> <img class="icon" src="assets/img/img_site/instagram.svg" alt="icon_instagram" width="30"></i></a>
            </div>

      </div>
      <div class="p-2 my-1 ">
       <h3><strong>Plan du site</strong></h3>
        <ul class="list-unstyled">
          <li><a href="#">Accueil</a></li>
          <li><a href="#">Profil</a></li>
          <li><a href="#">Mes réservations</a></li>
          <li><a href="#">Inscription</a></li>
        </ul>
      </div>
      <div class="p-2 my-1 ">
        <h3><strong>Email</strong></h3>
        <ul class="list-unstyled">
          <li>espaceshambaya@gmail.com</li>
        </ul>
        <h3><strong>Addresse</strong></h3>
        <ul class="list-unstyled">
          <li>260 voie Atlas   –   Athélia 3   –   13600 La Ciotat</li
        </ul>
      </div>
      <div class="p-2 ">
        <h3><strong>Horaires d'ouverture</strong></h3>
      
        <p class="">Lundi: 09.00 – 17.30</p>
        <p class="">Mardi: 09.00 – 17.30</p>
        <p class="">Mercredi: 09.00 – 17.30</p>
        <p class="">Jeudi: 09.00 – 17.30</p>
        <p class="">Vendredi: 09.00 – 17.30</p>
        <p class="">Samedi, Dimanche: Fermé</p>
      </div>
    </div>
  </div>
  <div> <p>Copyright © 2023 | Powered by</p> </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script defer>

    // Sélectionne tous les éléments avec la classe "calendar-box" et les stocke dans la variable selectHours
    const selectHours = document.querySelectorAll(".calendar-box");

    // Parcourt chaque élément selectHours
    selectHours.forEach(element => {
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
        })
    });
    
</script>
