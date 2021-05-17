<?php

// On récupère la liste des produits pouvant être vendu sans menu

$select = "SELECT plat.id, 
nomPlat AS nom,
prixPlat AS prix,
imagePlat AS image
FROM plat
UNION
SELECT dessert.id,
nomDessert AS nom,
prixDessert AS prix,
imageDessert AS image
FROM dessert
";

$req = $db->prepare($select);
$req->execute();

$plats = array();

while ($data = $req->fetchObject()) {
    array_push($plats, $data);
}

?>
<div class="container">
    <div class="row">
        <h1 id='intro' class="col-sm-12 mt-3 d-flex justify-content-center">Nos Produits seuls</h1>
    </div>
    <div class="row">
        <?php
        foreach ($plats as $plat) {
        ?>
            <div class="liste_produits col-sm-12 col-md-4 mt-5">
                <div class="card">
                    <img src="public/images/<?= $plat->image ?>" class="card-img-top w-50 d-flex mx-auto" alt="image Burger">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-center"><?= $plat->nom ?></h5>
                        <p class="card-text d-flex justify-content-center"><?= $plat->prix ?>€</p>
                        <a href="<?= $router->generate('produit_seul') ?>?nom=<?= $plat->nom ?>" class="btn btn-outline-dark d-flex justify-content-center mx-auto w-50">Voir plus</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>