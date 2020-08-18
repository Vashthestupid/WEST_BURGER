<?php

// On récupère l'identifiant présent dans la l'urldecode

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}

$select = "SELECT * FROM friture WHERE friture.id = :id";

$req = $db->prepare($select);
$req->bindParam(':id', $id);
$req->execute();

$friture = $req->fetchObject();

?>
<div class="container">
    <div class="row">
        <!-- Colonne NomProduit,imageProduit,prixProduit -->
        <div class="col-sm-12 offset-md-1 col-md-3 mt-3">
            <div class="informations">
                <h4 class="d-flex justify-content-center"><?= $friture->nomFriture ?></h4>
                <img class="w-75 ml-4" src="/public/images/<?= $friture->imageFriture ?>" alt="image <?= $friture->nomFriture ?>">
            </div>
        </div>
        <!-- Colonne Description puis gestion de la commande  -->
        <div class="col-sm-12 offset-md-2 col-md-4">
            <div class="information mt-3">
                <h5 class="d-flex justify-content-center">Composition du nuggets</h5>
                <p><?= $friture->descFriture ?></p>
                <form id="ajouter" method="post">
                    <div class="form-group">
                        <label class="d-flex" for="boîtes">Choisir la taille de la boîte</label>
                        <select name="boîte" id="boîte">
                            <option value="petite">Petite 4€</option>
                            <option value="Moyenne">Moyenne 8€</option>
                            <option value="Grande">Grande 12€</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="d-flex" for="quantité">Quantité</label>
                        <input type="number" name="quantite" id="quantite">
                    </div>
                    <input type="number" name="id" value="1" hidden>
                    <input class=" boutonValider btn btn-secondary mb-3" type="submit" value="Ajouter au panier">
                </form>
            </div>
        </div>
    </div>
</div>