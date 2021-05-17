<?php

// On récupère l'id du produit

if (isset($_GET['nom'])) {
    $nom = htmlspecialchars(trim($_GET['nom']));
}

// Ensuite on récupère toutes les informations en fonction du nom de ce produit

// Pour les plats

$select = "SELECT plat.id, 
nomPlat AS nom,
prixPlat AS prix,
descPlat AS description,
imagePlat AS image
FROM plat
WHERE nomPlat = :nomPlat";

$req = $db->prepare($select);
$req->bindParam(':nomPlat', $nom);
$req->execute();

$plat = $req->fetchObject();

// Les desserts

$selectFriture = "SELECT dessert.id, 
nomDessert AS nom,
prixDessert AS prix,
imageDessert AS image
FROM dessert 
WHERE nomDessert = :nomDessert";

$reqDessert = $db->prepare($selectFriture);
$reqDessert->bindParam(':nomDessert', $nom);
$reqDessert->execute();

$dessert = $reqDessert->fetchObject();

// Les fritures

$select = "SELECT friture.id,
nomFriture AS nom,
descFriture AS description,
prixFriture AS prix,
imageFriture AS image
FROM friture 
WHERE nomFriture = :nomFriture";

$reqFriture = $db->prepare($select);
$reqFriture->bindParam(':nomFriture', $nom);
$reqFriture->execute();

$friture = $reqFriture->fetchObject();

// On récupère la liste des suppléments

$selectSupplement = "SELECT supplements.id,nomSupplement FROM supplements";

$reqSupplement = $db->prepare($selectSupplement);
$reqSupplement->execute();

$supplements = array();

while ($data = $reqSupplement->fetchObject()) {
    array_push($supplements, $data);
}

// On insère le produit dans le panier
if ($_SESSION['login']) {
    if (isset($_POST['valider'])) {
        $quantite = intval($_POST['quantite']);
        $id = intval($_POST['id']);
        $prix = intval($_POST['prix']);

        $insert = "INSERT INTO panier(plat_id,utilisateur_id,quantite,prix,dateCommande) VALUES(:id,:idUser,:quantite,:prix,NOW())";

        $reqInsert = $db->prepare($insert);
        $reqInsert->bindParam(':id', $id);
        $reqInsert->bindParam(':idUser', $_SESSION['user']);
        $reqInsert->bindParam(':quantite', $quantite);
        $reqInsert->bindParam(':prix', $prix);
        $reqInsert->execute();

        echo 'Le produit a bien été ajouté au panier';
    } elseif (isset($_POST['validerPerso'])) {
        $supplement = intval($_POST['supplement']);
        $enlever = htmlspecialchars(trim($_POST['enlever']));
        $quantitePerso = intval($_POST['quantitePerso']);
        $idPerso = intval($_POST['idPerso']);
        $prixPerso = intval($_POST['prixPerso']);

        $insertPerso = "INSERT INTO panier(plat_id,utilisateur_id,supplements_id,quantite,prix,retrait,dateCommande) VALUES(:plat,:idUtilisateur,:supplement,:quantitePerso,:prixPerso,:retrait,NOW())";

        $reqInsertPerso = $db->prepare($insertPerso);
        $reqInsertPerso->bindParam(':plat', $idPerso);
        $reqInsertPerso->bindParam(':idUtilisateur', $_SESSION['user']);
        $reqInsertPerso->bindParam(':quantitePerso', $quantitePerso);
        $reqInsertPerso->bindParam(':prixPerso', $prixPerso);
        $reqInsertPerso->bindParam(':supplement', $supplement);
        $reqInsertPerso->bindParam(':retrait', $enlever);
        $reqInsertPerso->execute();

        echo 'Le produit a bien été ajouté au panier';
    // On ajoute le dessert au panier
    } elseif (isset($_POST['validerDessert'])) {
        $quantiteDessert = intval($_POST['quantiteDessert']);
        $prixDessert = intval($_POST['prixDessert']);
        $idDessert = intval($_POST['idDessert']);

        $insertDessert = "INSERT INTO panier(dessert_id,utilisateur_id,quantite,prix,dateCommande) VALUES(:idDessert,:utilisateur,:quantiteDessert,:prixDessert,NOW())";

        $reqInsertDessert = $db->prepare($insertDessert);
        $reqInsertDessert->bindParam(':idDessert', $idDessert);
        $reqInsertDessert->bindParam(':utilisateur', $_SESSION['user']);
        $reqInsertDessert->bindParam(':quantiteDessert', $quantiteDessert);
        $reqInsertDessert->bindParam(':prixDessert', $prixDessert);
        $reqInsertDessert->execute();

        echo 'Le produit a bien été ajouté au panier';
    // On ajoute la friture au panier
    } elseif (isset($_POST['validerFriture'])) {
        $quantiteFriture = intval($_POST['quantiteFriture']);
        $prixFriture = intval($_POST['prixFriture']);
        $idFriture = intval($_POST['idFriture']);

        $insertFriture = "INSERT INTO panier(friture_id,utilisateur_id,quantite,prix,dateCommande) VALUES(:friture,:user,:quantite,:prix,NOW())";

        $reqInsertFriture = $db->prepare($insertFriture);
        $reqInsertFriture->bindParam(':friture', $idFriture);
        $reqInsertFriture->bindParam(':user', $_SESSION['user']);
        $reqInsertFriture->bindParam(':quantite', $quantiteFriture);
        $reqInsertFriture->bindParam(':prix', $prixFriture);
        $reqInsertFriture->execute();

        echo 'Votre produit a bien été ajouté au panier';
    }
} else {
    echo "Vous devez être connecté pour ajouter ce produit au panier";
}

?>
<div class="container">
    <div class="row">
        <!-- Colonne NomProduit,imageProduit,prixProduit -->
        <?php
        if ($plat) {
        ?>
            <div class="col-sm-12 offset-md-1 col-md-3 mt-3">
                <div class="informations">
                    <h4 class="d-flex justify-content-center"><?= $plat->nom ?></h4>
                    <img class="w-75 ml-4" src="public/images/<?= $plat->image ?>" alt="image burger">
                    <p class="d-flex justify-content-center">Prix: <?= $plat->prix ?></p>
                </div>
            </div>
            <!-- Colonne Description puis gestion de la commande  -->
            <div class="col-sm-12 offset-md-2 col-md-4">
                <div class="information mt-3">
                    <h5 class="d-flex justify-content-center">Composition du plat</h5>
                    <p><?= $plat->description ?></p>
                    <form id="ajouter" method="post">
                        <div class="form-group">
                            <label for="quantité">Quantité</label>
                            <input type="number" name="quantite" id="quantite" value="1">
                        </div>
                        <input type="number" name="id" value="<?= $plat->id ?>" hidden>
                        <input type="number" name="prix" value="<?= $plat->prix ?>" hidden>
                        <input class=" boutonValider btn btn-secondary mb-3" type="submit" name="valider" value="Ajouter au panier">
                    </form>
                    <button id="personnaliser" class="open d-flex mx-auto mb-3">
                        Personnaliser
                    </button>
                    <form class="suppléments mt-3 mb-3" method="post">
                        <div class="form-group">
                            <label class="d-flex" for="supplement1">Supplément</label>
                            <?php
                            foreach ($supplements as $supplement) {
                            ?>
                                <select name="supplement" id="supplement">
                                    <option>Choix d'un supplément</option>
                                    <option value="<?= $supplement->id ?>"><?= $supplement->nomSupplement ?></option>
                                </select>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label class="d-flex" for="supplement1">Si vous souhaitez retirer un ou des ingrédient(s) veuillez l'indiquer ci-dessous.</label>
                            <input type="text" name="enlever" id="enlever">
                        </div>

                        <div class="form-group">
                            <label class="d-flex" for="quantite">Quantité</label>
                            <input type="number" name="quantitePerso" id="quantite" value="1">
                        </div>
                        <input type="number" name="idPerso" value="<?= $plat->id ?>" hidden>
                        <input type="number" name="prixPerso" value="<?= $plat->prix ?>" hidden>
                        <input class="boutonValider btn btn-secondary" type="submit" name="validerPerso" value="Ajouter au panier">
                    </form>
                </div>
            </div>
        <?php
        } elseif ($dessert) {
        ?>
            <div class="col-sm-12 offset-md-1 col-md-3 mt-3">
                <div class="informations">
                    <h4 class="d-flex justify-content-center"><?= $dessert->nom ?></h4>
                    <img class="w-75 ml-4" src="public/images/<?= $dessert->image ?>" alt="image burger">
                    <p class="d-flex justify-content-center">Prix: <?= $dessert->prix ?>€</p>
                </div>
            </div>
            <div class="col-sm-12 offset-md-2 col-md-4">
                <div class="information mt-3">
                    <h5 class="d-flex justify-content-center">Composition du dessert</h5>
                    <p><?= $dessert->description ?></p>
                    <form id="ajouter" method="post">
                        <div class="form-group">
                            <label for="quantité">Quantité</label>
                            <input type="number" name="quantiteDessert" id="quantite" value="1">
                        </div>
                        <input type="number" name="idDessert" value="<?= $dessert->id ?>" hidden>
                        <input type="number" name="prixDessert" value="<?= $dessert->prix ?>" hidden>
                        <input class=" boutonValider btn btn-secondary mb-3" type="submit" name="validerDessert" value="Ajouter au panier">
                    </form>
                </div>
            </div>
        <?php
        } elseif ($friture) {
        ?>
            <div class="col-sm-12 offset-md-1 col-md-3 mt-3">
                <div class="informations">
                    <h4 class="d-flex justify-content-center"><?= $friture->nom?></h4>
                    <img class="w-75 ml-4" src="/public/images/<?= $friture->image ?>" alt="image <?= $friture->nom ?>">
                </div>
            </div>
            <!-- Colonne Description puis gestion de la commande  -->
            <div class="col-sm-12 offset-md-2 col-md-4">
                <div class="information mt-3">
                    <h5 class="d-flex justify-content-center">Composition de la friture</h5>
                    <p><?= $friture->description?></p>
                    <form id="ajouter" method="post">
                        <div class="form-group">
                            <label class="d-flex" for="quantité">Quantité</label>
                            <input type="number" name="quantiteFriture" id="quantite" value="1">
                        </div>
                        <input type="number" name="idFriture" value="<?= $friture->id?>" hidden>
                        <input type="number" name="prixFriture" value="<?= $friture->prix ?>" hidden>
                        <input class=" boutonValider btn btn-secondary mb-3" name="validerFriture" type="submit" value="Ajouter au panier">
                    </form>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>