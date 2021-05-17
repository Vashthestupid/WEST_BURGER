<?php

// On récupère la totalité des plats

$select = "SELECT plat.id, nomPlat AS nom FROM plat";

$req = $db->prepare($select);
$req->execute();

$plats = array();

while ($data = $req->fetchObject()) {
    array_push($plats, $data);
}

// On récupère les accompagnements

$selectAccompagnement = "SELECT accompagnement.id, nomAccompagnement FROM accompagnement";

$reqAccompagnement = $db->prepare($selectAccompagnement);
$reqAccompagnement->execute();

$accompagnements = array();

while ($data = $reqAccompagnement->fetchObject()) {
    array_push($accompagnements, $data);
}

// On récupère les boissons

$selectBoisson = "SELECT boisson.id, nomBoisson FROM boisson";

$reqBoisson = $db->prepare($selectBoisson);
$reqBoisson->execute();

$boissons = array();

while ($data = $reqBoisson->fetchObject()) {
    array_push($boissons, $data);
}

if ($_SESSION['login']) {
    if (isset($_POST['valider'])) {
        $plat = intval($_POST['plat']);
        $accompagnement = intval($_POST['accompagnement']);
        $boisson = intval($_POST['boisson']);
        $dessert = intval($_POST['dessert']);
        $quantite  = intval($_POST['quantite']);

        // On insère d'abord dans la table menu

        $insert = "INSERT INTO menu(boisson_id,plat_id,Accompagnement_id) VALUES(:boisson,:plat,:accompagnement)";

        $reqInsert = $db->prepare($insert);
        $reqInsert->bindParam(':boisson', $boisson);
        $reqInsert->bindParam(':plat', $plat);
        $reqInsert->bindParam(':accompagnement', $accompagnement);
        $reqInsert->execute();

        // Maintenant on récupère le dernier id inséré
        $lastInsertIdMenu = $db->lastInsertId();

        // On récupère le prix du produit

        $selectPrix = "SELECT prix FROM menu WHERE id = :lastInsert";

        $reqPrix = $db->prepare($selectPrix);
        $reqPrix->bindParam(':lastInsert', $lastInsertIdMenu);
        $reqPrix->execute();

        $prixMenu = $reqPrix->fetchObject();
        $prix = $prixMenu->prix;

        // Puis on l'insère dans la table panier
        $insertPanier = "INSERT INTO panier(menu_id,utilisateur_id,quantite,prix,dateCommande) VALUE(:menu,:idUser,:quantite,:prix,NOW())";

        $insertPanier = $db->prepare($insertPanier);
        $insertPanier->bindParam(':menu', $lastInsertIdMenu);
        $insertPanier->bindParam(':idUser', $_SESSION['user']);
        $insertPanier->bindParam(':quantite', $quantite);
        $insertPanier->bindParam(':prix', $prix);
        $insertPanier->execute();

        echo 'Le produit a bien été ajouté au panier';
    }
} else {
    echo "Vous devez être connecté pour ajouter ce produit au panier";
}
?>
<div class="container">
    <div class="row">
        <!-- Colonne NomProduit,imageProduit,prixProduit -->
        <div class="col-sm-12 offset-md-1 col-md-3 mt-3">
            <div class="informations">
                <h4 class="d-flex justify-content-center">Menu</h4>
                <img class="w-75 ml-4" src="public/images/menu.png" alt="image menu">
                <p class="d-flex justify-content-center">Prix: 4€</p>
            </div>
        </div>
        <!-- Colonne Description puis gestion de la commande  -->
        <div class="col-sm-12 offset-md-2 col-md-4">
            <div class="information mt-3">
                <h5 class="d-flex justify-content-center">Contenu du menu</h5>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Mollitia, vitae quisquam. Fugit, necessitatibus, deserunt cumque nobis accusamus magni facilis, est vero iusto illum veritatis nulla? Obcaecati laborum dolorum aut vitae!</p>
                <form id="ajouter" method="post">
                    <div class="form-group">
                        <label class="d-flex" for="burger">Choisissez votre plat</label>
                        <select name="plat" id="plat">
                            <option>Plat</option>
                            <?php
                            foreach ($plats as $plat) {
                            ?>
                                <option value="<?= $plat->id ?>"><?= $plat->nom ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="d-flex" for="boisson">Frites ou potatoes</label>
                        <select name="accompagnement" id="accompagnement">
                            <option>Accompagnement</option>
                            <?php
                            foreach ($accompagnements as $accompagnement) {
                            ?>
                                <option value="<?= $accompagnement->id ?>"><?= $accompagnement->nomAccompagnement ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="d-flex" for="boisson">Choisissez votre boisson</label>
                        <select name="boisson" id="accompagnement">
                            <option>Boissons</option>
                            <?php
                            foreach ($boissons as $boisson) {
                            ?>
                                <option value="<?= $boisson->id ?>"><?= $boisson->nomBoisson ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="d-flex" for="quantite">Quantité</label>
                        <input type="number" name="quantite" id="quantite" value="1">
                    </div>
                    <input class="btn btn-secondary mb-5" name="valider" type="submit" value="Ajouter">
                </form>
            </div>
        </div>
    </div>
</div>