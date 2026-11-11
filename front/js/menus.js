// Affiche les menus récupérés depuis l'API
function afficherMenus() {
    const menusList = document.getElementById("menusList");
    const template = document.getElementById("menuTemplate");

    fetch(apiUrl + "menu")
        .then(response => {
            if (!response.ok) {
                throw new Error("Erreur HTTP : " + response.status);
            }
            return response.json();
        })
        .then(menus => {
            menus.forEach(menu => {
                // on copie le modèle de carte
                const carte = template.content.cloneNode(true);

                // textContent pour éviter d'injecter du HTML (faille XSS)
                carte.querySelector(".menu-titre").textContent = menu.titre;
                carte.querySelector(".menu-personnes").textContent = "≥ " + menu.nombrePersonneMinimum + " personnes";
                carte.querySelector(".menu-prix").textContent = Number(menu.prixParPersonne) + "€";

                // image du menu = photo du plat principal
                const image = carte.querySelector(".menu-image");
                menu.plats.forEach(plat => {
                    if (plat.photo != null) {
                        image.src = "/images/" + plat.photo;
                    }
                });
                image.alt = menu.titre;

                // liste des plats
                const listePlats = carte.querySelector(".menu-plats");
                menu.plats.forEach(plat => {
                    const li = document.createElement("li");
                    li.textContent = plat.titrePlat;
                    listePlats.appendChild(li);
                });

                menusList.appendChild(carte);
            });
        })
        .catch(error => {
            console.error("Erreur :", error);
            menusList.textContent = "Impossible de charger les menus pour le moment.";
        });
}

// tout est dans une fonction, sinon erreur "already declared" quand on revient sur la page
afficherMenus();
