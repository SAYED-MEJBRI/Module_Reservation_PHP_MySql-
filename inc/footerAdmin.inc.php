
<footer class="  ">
  <div class="mw-1320 m-auto  my-3">
    <div class="d-flex fw-wrap g-1 jc-se  ">
      <div class="p-2 my-1 ">
      <strong>Espace Shambaya</strong></h4>
      <div class="p-1 text-center my-3">
                <a class="btn p-1" href="#"> <img class="icon" src="../assets/img/img_site/facebook.svg" alt="icon_fcb" width="30"></i></a>
                <a class="btn p-1" href="#"> <img class="icon" src="../assets/img/img_site/youtube.svg" alt="icon_youtube" width="30"></i></a>
                <a class="btn p-1" href="#"> <img class="icon" src="../assets/img/img_site/instagram.svg" alt="icon_instagram" width="30"></i></a>
            </div>

      </div>
      <div class="p-2 my-1 ">
        <h4><strong>Plan du site</strong></h4>
        <ul class="list-unstyled">
          <li><a class="isDisabled" href="#">Rooms</a></li>
          <li><a href="#">Practitioners</a></li>
          <li><a href="#">Connexion</a></li>
          <li><a href="#">Inscription</a></li>
        </ul>
      </div>
      <div class="p-2 my-1 ">
        <h4><strong>Email</strong></h4>
        <ul class="list-unstyled">
          <li>espaceshambaya@gmail.com</li
        </ul>
        <h4 class="my-3 my-1 "><strong>Addresse</strong></h4>
        <ul class="list-unstyled">
          <li>260 voie Atlas   –   Athélia 3   –   13600 La Ciotat</li
        </ul>
      </div>
      <div class="p-2 ">
        <h4><strong>Horaires d'ouverture</strong></h4>
      
        <p class="">Lundi: 09.00 – 17.30</p>
        <p class="">Mardi: 09.00 – 17.30</p>
        <p class="">Mardi: 09.00 – 17.30</p>
        <p class="">Mardi: 09.00 – 17.30</p>
        <p class="">Mardi: 09.00 – 17.30</p>
        <p class="">Samedi, Dimanche: Fermé</p>
      </div>
    </div>
  </div>
  <div> <p>Copyright © 2023 | Powered by</p> </div>
</footer>
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