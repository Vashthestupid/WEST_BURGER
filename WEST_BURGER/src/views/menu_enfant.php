<?php

// On récupére le Hamburger

$selectHamburger = "SELECT * FROM plat WHERE nomPlat = 'Hamburger'";

$reqHamburger = $db->prepare($selectHamburger);
$reqHamburger->execute();

$hamburger = $reqHamburger->fetcHobject();

// On récupére le croque

$selectCroque = "SELECT * FROM plat WHERE nomPlat = 'Croque'";

$reqCroque = $db->prepare($selectCroque);
$reqCroque->execute();

$croque = $reqCroque->fetchObject();

// On récupére les nuggets

$selectNuggets = "SELECT * FROM friture WHERE nomFriture = 'Nuggets'";

$reqNuggets = $db->prepare($selectNuggets);
$reqNuggets->execute();

$nuggets = $reqNuggets->fetchObject();

// On récupère la liste des accompagnements

$selectAccommpagnement = "SELECT accompagnement.id, nomAccompagnement FROM accompagnement";

$reqAccompagnement = $db->prepare($selectAccommpagnement);
$reqAccompagnement->execute();

$accompagnements = array();

while ($data = $reqAccompagnement->fetchObject()) {
    array_push($accompagnements, $data);
}

// On insére le menu enfant dans la table menuEnfant
if ($_SESSION['login']) {
    if (isset($_POST['valider'])) {
        $plat = intval($_POST['plat']);
        $accompagnement = intval($_POST['accompagnement']);
        $quantite = intval($_POST['quantite']);

        if ($plat == "1" || $plat == "2") {
            $insert = "INSERT INTO menuenfant(plat_id,Accompagnement_id) VALUES(:plat,:accompagnement)";

            $reqInsert = $db->prepare($insert);
            $reqInsert->bindParam(':plat', $plat);
            $reqInsert->bindParam(':accompagnement', $accompagnement);
            $reqInsert->execute();

            $lastInsertIdMenuEnfant = $db->lastInsertId();

            // On récupère le prix du menu

            $selectPrix = "SELECT prix FROM menuenfant WHERE id = :lastInsert";

            $reqPrix = $db->prepare($selectPrix);
            $reqPrix->bindParam(':lastInsert', $lastInsertIdMenuEnfant);
            $reqPrix->execute();

            $prixMenu = $reqPrix->fetchObject();
            $prix = $prixMenu->prix;

            // Puis dans le panier

            $insertMenuEnfant = "INSERT INTO panier(menuEnfant_id,utilisateur_id,quantite,prix,dateCommande) VALUES(:menuEnfant,:idUtilisateur,:quantite,:prix,NOW())";

            $reqInsertMenuEnfant = $db->prepare($insertMenuEnfant);
            $reqInsertMenuEnfant->bindParam(':menuEnfant', $lastInsertIdMenuEnfant);
            $reqInsertMenuEnfant->bindParam(':idUtilisateur', $_SESSION['user']);
            $reqInsertMenuEnfant->bindParam(':quantite', $quantite);
            $reqInsertMenuEnfant->bindParam(':prix', $prix);
            $reqInsertMenuEnfant->execute();

            echo 'Le produit a bien été ajouté au panier';
        } elseif ($plat == "3") {
            $insertNuggets = "INSERT INTO menuenfant(friture_id,Accompagnement_id) VALUES(:plat,:accompagnement)";

            $reqInsertNuggets = $db->prepare($insertNuggets);
            $reqInsertNuggets->bindParam(':plat', $plat);
            $reqInsertNuggets->bindParam(':accompagnement', $accompagnement);
            $reqInsertNuggets->execute();

            $lastInsertIdMenuEnfantNuggets = $db->lastInsertId();

            // On récupère le prix du menu

            $selectPrixNuggets = "SELECT prix FROM menuenfant WHERE id = :lastInsertNuggets";

            $reqPrixNuggets = $db->prepare($selectPrixNuggets);
            $reqPrixNuggets->bindParam(':lastInsertNuggets', $lastInsertIdMenuEnfantNuggets);
            $reqPrixNuggets->execute();

            $prixMenuNuggets = $reqPrixNuggets->fetchObject();
            $prixNuggets = $prixMenuNuggets->prix;

            // Puis dans le panier

            $insertNuggetsPanier = "INSERT INTO panier(menuEnfant_id,utilisateur_id,quantite,prix,dateCommande) VALUES(:menu,:idUser,:quantite,:prixNuggets,NOW())";

            $reqInsertMenuEnfantNuggets = $db->prepare($insertNuggetsPanier);
            $reqInsertMenuEnfantNuggets->bindParam(':menu', $lastInsertIdMenuEnfantNuggets);
            $reqInsertMenuEnfantNuggets->bindParam(':idUser', $_SESSION['user']);
            $reqInsertMenuEnfantNuggets->bindParam(':quantite', $quantite);
            $reqInsertMenuEnfantNuggets->bindParam(':prixNuggets', $prixNuggets);
            $reqInsertMenuEnfantNuggets->execute();

            echo "Le produit a bien été ajouté";
        }
    }
} else {
    echo "Vous devez être connecté pour mettre ce produit au panier";
}

?>
<div class="container">
    <div class="row">
        <!-- Colonne NomProduit,imageProduit,prixProduit -->
        <div class="col-sm-12 offset-md-1 col-md-3 mt-3">
            <div class="informations">
                <h4 class="d-flex justify-content-center">Menu Enfant</h4>
                <img class="w-75 ml-4" src="public/images/menu_enfant.png" alt="image menu enfant">
                <p class="d-flex justify-content-center">Prix: 4€</p>
            </div>
        </div>
        <!-- Colonne Description puis gestion de la commande  -->
        <div class="col-sm-12 offset-md-2 col-md-4">
            <div class="information mt-3">
                <h5 class="d-flex justify-content-center">Contenu du menu enfant</h5>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Mollitia, vitae quisquam. Fugit, necessitatibus, deserunt cumque nobis accusamus magni facilis, est vero iusto illum veritatis nulla? Obcaecati laborum dolorum aut vitae!</p>
                <form id="ajouter" method="post">
                    <div class="form-group">
                        <label class="d-flex" for="burger">Choisissez votre plat</label>
                        <input type="radio" name="plat" id="hamburger" autocomplete="off" value="<?= $hamburger->id ?>"> Hamburger
                        <input type="radio" name="plat" id="croque" autocomplete="off" value="<?= $croque->id ?>"> Croque
                        <input type="radio" name="plat" id="nuggets" autocomplete="off" value="<?= $nuggets->id ?>"> Nuggets
                    </div>
                    <label class="d-flex" for="boisson">Frites ou potatoes</label>
                    <select class="mb-3" name="accompagnement" id="accompagnement">
                        <option>Accompagnement</option>
                        <?php
                        foreach ($accompagnements as $accompagnement) {
                        ?>
                            <option value="<?= $accompagnement->id ?>"><?= $accompagnement->nomAccompagnement ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <div class="form-group">
                        <label class="d-flex" for="quantite">Quantité</label>
                        <input type="number" name="quantite" id="quantite" value="1">
                    </div>
                    <input class="btn btn-secondary" name="valider" type="submit" value="Ajouter">
                </form>
            </div>
        </div>
    </div>
</div>