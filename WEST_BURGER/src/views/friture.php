<?php

// On récupère tous les types de fritures

$select = "SELECT friture.id, nomFriture, prixFriture, imageFriture FROM friture";

$req = $db->prepare($select);
$req->execute();

$fritures = array();

while ($data = $req->fetchObject()) {
    array_push($fritures, $data);
}

?>
<div class="container">
    <div class="row">
        <h1 id='intro' class="col-sm-12 mt-3 d-flex justify-content-center">Nos Fritures</h1>
    </div>
    <div class="row">
        <div class="liste_produits col-sm-12 col-md-4 mt-5">
            <?php
            foreach ($fritures as $friture) {
            ?>
                <div class="card">
                    <img src="public/images/<?= $friture->imageFriture?>" class="card-img-top w-50 d-flex mx-auto" alt="image Nuggets">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-center"><?= $friture->nomFriture?></h5>
                        <p class="card-text d-flex justify-content-center"><?= $friture->prixFriture?>€</p>
                        <a href="<?= $router->generate('fiche_friture')?>?id=<?= $friture->id?>" class="btn btn-outline-dark d-flex justify-content-center mx-auto w-50">Voir plus</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>