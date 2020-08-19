<?php

session_start();
error_reporting(E_ALL & ~E_NOTICE);
require "vendor/autoload.php";
require "src/views/elements/header.php";
require "src/views/elements/footer.php";
require "src/config/config.php";
require "src/model/connect.php";

$db = connection();

head();

//Partie Connexion

// Partie connexion de l'administrateur ou de l'utilisateur

if (isset($_POST['email']) && isset($_POST['mdp'])) {
    $email = htmlspecialchars(trim($_POST['email']));
    $mdp = htmlspecialchars(trim($_POST['mdp']));

    $selectUser = "SELECT * FROM utilisateur WHERE mailUtilisateur = :mail";

    $reqSelectUser = $db->prepare($selectUser);
    $reqSelectUser->bindParam(':mail', $email);
    $reqSelectUser->execute();

    // Je récupère les informations présentes dans la base de données pour les utiliser plus tard 
    $data = $reqSelectUser->fetchObject();
    $_SESSION['prenom'] = $data->prenomUtilisateur;
    $_SESSION['nom'] = $data->nomUtilisateur;
    $_SESSION['role'] = $data->typeUtilisateur_id;
    $_SESSION['user'] = $data->id;

    $passwordValid = password_verify($mdp, $data->mdpUtilisateur);

    if ($passwordValid) {

        if (isset($_SESSION['login'])) {
            $email = $_SESSION['login'];
        } else {
            $_SESSION['login'] = $_POST['email'];
            $mail = $_SESSION['login'];

            header('Location: /');
            // echo '<meta http-equiv="refresh" content="0; url=/"/>';
        }
    } else {
        header('location: /?erreur= Identifiant ou mot de passe invalide');
        // echo '<meta http-equiv="refresh" content="0;/?erreur=Identifiant ou mot de passe invalide"/>';
    }

    if (isset($_SESSION['login'])) {
        $mail = $_SESSION['login'];
    } else {
        $mail = '';
    }
}


// Partie Router

$router = new AltoRouter();

$router->map('GET|POST', '/', '/', 'Home');
$router->map('GET|POST', '/Qui_sommes_nous_?', '/Qui_sommes_nous_?', 'Qui_sommes_nous?');
$router->map('GET|POST', '/Inscription_&_Connexion', '/Inscription_&_Connexion', 'Inscription_&_Connexion');
$router->map('GET|POST', '/Salades', '/Salades', 'Salades');
$router->map('GET|POST', '/Menus', '/Menus', 'Menus');
$router->map('GET|POST', '/Produits_seuls', '/Produits_seuls', 'Produits_seuls');
$router->map('GET|POST', '/Fritures', '/Fritures', 'Fritures');
$router->map('GET|POST', '/Menu_enfant', '/Menu_enfant', 'Menu_enfant');
$router->map('GET|POST', '/Menu_salade', '/Menu_salade', 'Menu_salade');
$router->map('GET|POST', '/fiche_friture', '/fiche_friture', 'fiche_friture');
$router->map('GET|POST', '/produit_seul', '/produit_seul', 'produit_seul');
$router->map('GET|POST', '/Deconnexion', '/Deconnexion', 'Deconnexion');
$router->map('GET|POST', '/admin/utilisateurs', 'utilisateurs', 'utilisateurs');
$router->map('GET|POST', '/admin/utilisateurs/Voir_utilisateur', 'Voir_utilisateur', 'Voir_utilisateur');
$router->map('GET|POST', '/admin/utilisateurs/Editer_utilisateur', 'Editer_utilisateur', 'Editer_utilisateur');
$router->map('GET|POST', '/admin/plats', 'plats', 'plats');
$router->map('GET|POST', '/admin/plats/Nouveau_plat', 'Nouveau_plat', 'Nouveau_plat');
$router->map('GET|POST', '/admin/plats/Voir_plat', 'Voir_plat', 'Voir_plat');
$router->map('GET|POST', '/admin/plats/Editer_plat', 'Editer_plat', 'Editer_plat');
$router->map('GET|POST', '/admin/salades', 'salades', 'salades');
$router->map('GET|POST', '/admin/salades/Nouvelle_salade', 'Nouvelle_salade', 'Nouvelle_salade');
$router->map('GET|POST', '/admin/salades/Voir_salade', 'Voir_salade', 'Voir_salade');
$router->map('GET|POST', '/admin/salades/Editer_salade', 'Editer_salade', 'Editer_salade');
$router->map('GET|POST', '/admin/fritures', 'fritures', 'fritures');
$router->map('GET|POST', '/admin/fritures/Nouvelle_friture', 'Nouvelle_friture', 'Nouvelle_friture');
$router->map('GET|POST', '/admin/fritures/Voir_Friture', 'Voir_friture', 'Voir_friture');
$router->map('GET|POST', '/admin/fritures/Editer_Friture', 'Editer_friture', 'Editer_friture');
$router->map('GET|POST', '/admin/accompagnements', 'accompagnements', 'accompagnements');
$router->map('GET|POST', '/admin/accompagnements/Nouvel_accompagnement', 'Nouvel_accompagnement', 'Nouvel_accompagnement');
$router->map('GET|POST', '/admin/accompagnements/Voir_accompagnement', 'Voir_accompagnement', 'Voir_accompagnement');
$router->map('GET|POST', '/admin/accompagnements/Editer_accompagnement', 'Editer_accompagnement', 'Editer_accompagnement');
$router->map('GET|POST', '/admin/desserts', 'desserts', 'desserts');
$router->map('GET|POST', '/admin/desserts/Nouveau_dessert', 'Nouveau_dessert', 'Nouveau_dessert');
$router->map('GET|POST', '/admin/desserts/Voir_dessert', 'Voir_dessert', 'Voir_dessert');
$router->map('GET|POST', '/admin/desserts/Editer_dessert', 'Editer_dessert', 'Editer_dessert');
$router->map('GET|POST', '/admin/boissons', 'boissons', 'boissons');
$router->map('GET|POST', '/admin/boissons/Nouvelle_boisson', 'Nouvelle_boisson', 'Nouvelle_boisson');
$router->map('GET|POST', '/admin/boissons/Voir_boisson', 'Voir_boisson', 'Voir_boisson');
$router->map('GET|POST', '/admin/boissons/Editer_boisson', 'Editer_boisson', 'Editer_boisson');

$match = $router->match();

if ($match['target'] == '/') {
    require "src/views/home.php";
} elseif ($match['target'] == '/Qui_sommes_nous_?') {
    require "src/views/qui_sommes_nous.php";
} elseif ($match['target'] == "/Inscription_&_Connexion") {
    require "src/views/inscription.php";
} elseif ($match['target'] == "/Salades") {
    require "src/views/salades.php";
} elseif ($match['target'] == "/Menus") {
    require "src/views/menus.php";
} elseif ($match['target'] == "/Produits_seuls") {
    require "src/views/produits_seuls.php";
} elseif ($match['target'] == "/Fritures") {
    require "src/views/friture.php";
} elseif ($match['target'] == "/Menu_enfant") {
    require "src/views/menu_enfant.php";
} elseif ($match['target'] == "/Menu_salade") {
    require "src/views/menu_salade.php";
} elseif ($match['target'] == "/fiche_friture") {
    require "src/views/ficheFriture.php";
} elseif ($match['target'] == "/produit_seul") {
    require "src/views/produitSeul.php";
} elseif ($match['target'] == "/Deconnexion") {
    require "src/views/deconnexion.php";
} elseif ($match['target'] == "utilisateurs") {
    require "src/views/admin/utilisateurs/index_utilisateur.php";
} elseif ($match['target'] == "Voir_utilisateur") {
    require "src/views/admin/utilisateurs/voirUtilisateur.php";
} elseif ($match['target'] == "Editer_utilisateur") {
    require "src/views/admin/utilisateurs/modifierUtilisateur.php";
} elseif ($match['target'] == "plats") {
    require "src/views/admin/plats/index_plat.php";
} elseif ($match['target'] == "Nouveau_plat") {
    require "src/views/admin/plats/nouveauPlat.php";
} elseif ($match['target'] == "Voir_plat") {
    require "src/views/admin/plats/voirPlat.php";
} elseif ($match['target'] == "Editer_plat") {
    require "src/views/admin/plats/modifierPlat.php";
} elseif ($match['target'] == "salades") {
    require "src/views/admin/salades/index_salade.php";
} elseif ($match['target'] == "Nouvelle_salade") {
    require "src/views/admin/salades/nouvelleSalade.php";
} elseif ($match['target'] == "Voir_salade") {
    require "src/views/admin/salades/voirSalade.php";
} elseif ($match['target'] == "Editer_salade") {
    require "src/views/admin/salades/modifierSalade.php";
} elseif ($match['target'] == "fritures") {
    require "src/views/admin/fritures/index_fritures.php";
} elseif ($match['target'] == "Nouvelle_friture") {
    require "src/views/admin/fritures/nouvellefriture.php";
} elseif ($match['target'] == "Voir_friture") {
    require "src/views/admin/fritures/voirFriture.php";
} elseif ($match['target'] == "Editer_friture") {
    require "src/views/admin/fritures/modifierfriture.php";
} elseif ($match['target'] == "accompagnements") {
    require "src/views/admin/accompagnements/index_accompagnement.php";
} elseif ($match['target'] == "Nouvel_accompagnement") {
    require "src/views/admin/accompagnements/nouvelAccompagnement.php";
} elseif ($match['target'] == "Voir_accompagnement") {
    require "src/views/admin/accompagnements/voirAccompagnement.php";
} elseif ($match['target'] == "Editer_accompagnement") {
    require "src/views/admin/accompagnements/modifierAccompagnement.php";
} elseif ($match['target'] == "desserts") {
    require "src/views/admin/desserts/index_dessert.php";
} elseif ($match['target'] == "Nouveau_dessert") {
    require "src/views/admin/desserts/nouveauDessert.php";
} elseif ($match['target'] == "Voir_dessert") {
    require "src/views/admin/desserts/voirDessert.php";
} elseif ($match['target'] == "Editer_dessert") {
    require "src/views/admin/desserts/modifierDessert.php";
} elseif ($match['target'] == "boissons") {
    require "src/views/admin/boissons/index_boissons.php";
} elseif ($match['target'] == "Nouvelle_boisson") {
    require "src/views/admin/boissons/nouvelleBoisson.php";
} elseif ($match['target'] == "Voir_boisson") {
    require "src/views/admin/boissons/voirBoisson.php";
} elseif ($match['target'] == "Editer_boisson") {
    require "src/views/admin/boissons/modifierBoisson.php";
}



footer();
