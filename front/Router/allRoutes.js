import Route from "./Route.js";
//Définir ici vos routes
export const allRoutes = [
    new Route("/", "Accueil", "pages/home.html",[]),
    new Route("/menus", "Menus", "pages/menus.html",[], "js/menus.js"),
    new Route("/contact", "Contact", "pages/contact.html",[]),
    new Route("/signin", "Connexion", "pages/auth/signin.html",["disconnected"], "js/auth/signin.js"),
    new Route("/signup", "Inscription", "pages/auth/signup.html",["disconnected"], "js/auth/signup.js"),
    new Route("/account", "Mes Informations", "pages/auth/account.html",["admin", "user", "employee"]),
    new Route("/editPassword", "Modifier le mot de passe", "pages/auth/editPassword.html",["admin", "user", "employee"], "js/auth/editPassword.js"),
    new Route("/myOrders", "Mes Commandes", "pages/myOrders.html",["admin", "user", "employee"]),
    new Route("/order", "Commander", "pages/order.html",["admin", "user", "employee"]),
    new Route("/conditions_generales_de_vente", "Conditions générales de vente", "pages/infos/conditions_generales_de_vente.html",[]),
    new Route("/mentions_legales", "Mentions légales", "pages/infos/mentions_legales.html",[]),
];
//Le titre s'affiche comme ceci : Route.titre - websitename
export const websiteName = "Vite & Gourmand";