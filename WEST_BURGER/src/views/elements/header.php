<?php

function head()
{
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="/public/images/favicon.png" />
        <title>West Burger - Nos Sandwichs</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/public/css/main.css">

    </head>

    <body>
        <!-- Barre de navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/"><img id="logo_site" src="/public/images/logo_west_burger.png" alt="Logo West Burger"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a id="lien_sous_menu" class="nav-link">Nos Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Qui_sommes_nous_?">Qui sommes nous ?</a>
                    </li>
                    <?php
                    if (!$_SESSION['login']) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/Inscription_&_Connexion">Inscription/Connexion</a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $_SESSION['prenom'] . ' ' . $_SESSION['nom'] . '' ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/Mon_compte">Mon compte</a>
                                <a class="dropdown-item" href="/Mes_commandes">Mes commandes</a>
                                <a class="dropdown-item" href="/Deconnexion">Deconnexion</a>
                                <?php
                                if ($_SESSION['role'] === '2') {
                                ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/admin/utilisateurs">Liste des utilisateurs</a>
                                    <a class="dropdown-item" href="/admin/plats">Liste des plats</a>
                                    <a class="dropdown-item" href="/admin/salades">Liste des salades</a>
                                    <a class="dropdown-item" href="/admin/fritures">Liste des fritures</a>
                                    <a class="dropdown-item" href="/admin/accompagnements">Liste des accompagnements</a>
                                    <a class="dropdown-item" href="/admin/desserts">Liste des desserts</a>
                                    <a class="dropdown-item" href="/admin/boissons">Liste des boissons</a>
                                <?php
                                } else {
                                    ?>
                                    <?= ""?>
                                    <?php
                                }
                                ?>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>

        <!-- Sous menu -->

        <div id="sous_menu">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 offset-md-2 col-md-5">
                        <img class="logo_produit" src="/public/images/salade.png" alt="image Salade">
                        <a class="lien_produit" href="Salades">Menu Salade</a>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <img class="logo_produit" src="/public/images/menu.png" alt="image menu">
                        <a class="lien_produit" href="Menus">Nos Menus</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 offset-md-4 col-md-5">
                        <img src="/public/images/burger.png" alt="image burger" class="logo_produit">
                        <a href="Produits_seuls" class="lien_produit">Nos produits seuls</a>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-sm-12 offset-md-2 col-md-5">
                        <img class="logo_produit" src="/public/images/nuggets.png" alt="image menu">
                        <a class="lien_produit" href="Fritures">Nos Fritures</a>
                    </div>
                    <div class=" col-sm-12 col-md-4">
                        <img class="logo_produit" src="/public/images/menu_enfant.png" alt="image menu">
                        <a class="lien_produit" href="Menu_enfant">Menu Enfant</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu  -->

        <section id="content">
        <?php
    }
