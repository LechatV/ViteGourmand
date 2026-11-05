import Route from "./Route.js";
//Définir ici vos routes
export const allRoutes = [
    new Route("/", "Accueil", "pages/home.html",[]),
    new Route("/menus", "Menus", "pages/menus.html",[]),
    new Route("/contact", "Contact", "pages/contact.html",[]),
    new Route("/signin", "Connexion", "pages/signin.html", "js/auth/signin.js",["disconnected"]),
    new Route("/signup", "Inscription", "pages/signup.html", "js/auth/signup.js",["disconnected"]),
    new Route("/conditions_generales_de_vente", "Conditions générales de vente", "pages/conditions_generales_de_vente.html",[]),
    new Route("/mentions_legales", "Mentions légales", "pages/mentions_legales.html",[]),
];
//Le titre s'affiche comme ceci : Route.titre - websitename
export const websiteName = "Vite & Gourmand";