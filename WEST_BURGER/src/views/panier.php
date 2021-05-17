<?php

// On récupère le panier de l'utilisateur grâce à son id de session

// On récupère le nombre d'entrées dans le panier

$selectNumber = "SELECT COUNT(id) AS nb FROM panier WHERE panier.utilisateur_id = :panierUtilisateur";

$reqNumber = $db->prepare($selectNumber);
$reqNumber->bindParam(':panierUtilisateur', $_SESSION['user']);
$reqNumber->execute();

$nb = $reqNumber->fetchObject();
// Le menu salade

$select = "SELECT panier.id, 
nomMenuSalade AS nom,
nomSalade AS produit,
nomBoisson AS boisson,
panier.prix,
panier.quantite
FROM panier
INNER JOIN menusalade ON panier.menuSalade_id = menusalade.id
INNER JOIN salade ON menusalade.salade_id = salade.id
INNER JOIN boisson ON menusalade.boisson_id = boisson.id
WHERE panier.utilisateur_id = :id ";

$req = $db->prepare($select);
$req->bindParam(':id', $_SESSION['user']);
$req->execute();

$salades = array();

while ($data = $req->fetchObject()) {
    array_push($salades, $data);
}

// Le menu normal

$selectMenu = "SELECT panier.id,
nomMenu as nom,
nomPlat as produit,
nomAccompagnement as accompagnement,
nomBoisson as boisson,
panier.prix,
panier.quantite
FROM panier
INNER JOIN menu ON panier.menu_id = menu.id
INNER JOIN plat ON menu.plat_id = plat.id
INNER JOIN Accompagnement ON menu.Accompagnement_id = Accompagnement.id
INNER JOIN boisson ON menu.boisson_id = boisson.id
WHERE panier.utilisateur_id = :idUser";

$reqSelectMenu = $db->prepare($selectMenu);
$reqSelectMenu->bindParam(':idUser', $_SESSION['user']);
$reqSelectMenu->execute();

$menus = array();

while ($data = $reqSelectMenu->fetchObject()) {
    array_push($menus, $data);
}

// Le menu enfant avec un plat

$selectMenuEnfant = "SELECT panier.id,
nomMenuEnfant AS nom,
nomPlat AS produit,
nomAccompagnement AS accompagnement,
nomBoisson AS boisson,
nomDessert AS dessert,
panier.prix,
panier.quantite
FROM panier
INNER JOIN menuenfant ON panier.menuEnfant_id = menuenfant.id
INNER JOIN plat ON menuenfant.plat_id = plat.id
INNER JOIN accompagnement ON menuenfant.Accompagnement_id = Accompagnement.id
INNER JOIN boisson ON menuenfant.boisson_id = boisson.id
INNER JOIN dessert ON menuenfant.dessert_id = dessert.id
WHERE panier.utilisateur_id = :idUtilisateur";

$reqSelectMenuEnfant = $db->prepare($selectMenuEnfant);
$reqSelectMenuEnfant->bindParam(':idUtilisateur', $_SESSION['user']);
$reqSelectMenuEnfant->execute();

$menusEnfant = array();

while ($data = $reqSelectMenuEnfant->fetchObject()) {
    array_push($menusEnfant, $data);
}

// Le menu enfant avec les nuggets

$selectMenuEnfantNuggets = "SELECT panier.id, 
nomMenuEnfant AS nom,
nomFriture AS produit,
nomAccompagnement AS accompagnement,
nomBoisson AS boisson,
nomDessert AS dessert,
panier.prix,
panier.quantite
FROM panier
INNER JOIN menuenfant ON panier.menuEnfant_id = menuenfant.id
INNER JOIN friture ON menuenfant.friture_id = friture.id
INNER JOIN accompagnement ON menuenfant.Accompagnement_id = Accompagnement.id
INNER JOIN boisson ON menuenfant.boisson_id = boisson.id
INNER JOIN dessert ON menuenfant.dessert_id = dessert.id
WHERE panier.utilisateur_id = :idUtilisateurNuggets";

$reqMenuEnfantNuggets = $db->prepare($selectMenuEnfantNuggets);
$reqMenuEnfantNuggets->bindParam(':idUtilisateurNuggets', $_SESSION['user']);
$reqMenuEnfantNuggets->execute();

$menuEnfantNuggets = array();

while ($data = $reqMenuEnfantNuggets->fetchObject()) {
    array_push($menuEnfantNuggets, $data);
}

// Le produit seul sans personnalisation

$selectProduitSeul = "SELECT panier.id,
nomPlat AS nom,
panier.quantite,
panier.prix
FROM panier
INNER JOIN plat on panier.plat_id = plat.id
WHERE panier.utilisateur_id = :user AND retrait IS NULL AND supplements_id IS NULL";

$reqProduitSeul = $db->prepare($selectProduitSeul);
$reqProduitSeul->bindParam(':user', $_SESSION['user']);
$reqProduitSeul->execute();

$plats = array();

while ($data = $reqProduitSeul->fetchObject()) {
    array_push($plats, $data);
}

// Le produit seul avec personnalisation

$selectProduitSeulPerso = "SELECT panier.id,
nomPlat AS nom,
nomSupplement AS supplement,
panier.quantite,
panier.prix,
retrait
FROM panier
INNER JOIN plat on panier.plat_id = plat.id
INNER JOIN supplements on panier.supplements_id = supplements.id
WHERE panier.utilisateur_id = :utilisateur";

$reqProduitSeulPerso = $db->prepare($selectProduitSeulPerso);
$reqProduitSeulPerso->bindParam(':utilisateur', $_SESSION['user']);
$reqProduitSeulPerso->execute();

$platsPerso = array();

while ($data = $reqProduitSeulPerso->fetchObject()) {
    array_push($platsPerso, $data);
}

$selectFriture = "SELECT panier.id,
nomFriture as nom,
panier.quantite,
panier.prix
FROM panier
INNER JOIN friture ON panier.friture_id = friture.id
WHERE panier.utilisateur_id = :userFriture";

$reqFriture = $db->prepare($selectFriture);
$reqFriture->bindParam(':userFriture', $_SESSION['user']);
$reqFriture->execute();

$fritures = array();

while($data = $reqFriture->fetchObject()){
    array_push($fritures,$data);
}

// Le dessert

$selectDessert = "SELECT panier.id,
nomDessert AS nom,
panier.quantite,
panier.prix
FROM panier
INNER JOIN dessert ON panier.dessert_id = dessert.id
WHERE panier.utilisateur_id = :mangeur";

$reqDessert = $db->prepare($selectDessert);
$reqDessert->bindParam(':mangeur', $_SESSION['user']);
$reqDessert->execute();

$desserts = array();

while ($data = $reqDessert->fetchObject()) {
    array_push($desserts, $data);
}

// Calculer le montant total du panier

$selectMontantTotal = "SELECT SUM(panier.prix * panier.quantite) AS total FROM panier WHERE panier.utilisateur_id = :utilisateur";

$reqMontantTotal = $db->prepare($selectMontantTotal);
$reqMontantTotal->bindParam(':utilisateur', $_SESSION['user']);
$reqMontantTotal->execute();

$total = $reqMontantTotal->fetchObject();

?>
<div class="container">
    <h2 class="d-flex justify-content-center mt-2">Mon panier</h2>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <?php
            if ($nb->nb == 0) {
                echo '<p class="d-flex justify-content-center mt-3">Votre panier est vide</p>';
            } else {
            ?>
                <div class="table-responsive">
                    <table class="table mt-3 col-sm-12">
                        <thead>
                            <tr>
                                <th>Nom du produit</th>
                                <th>Quantité</th>
                                <th>Prix</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($salades as $salade) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $salade->nom ?>
                                        <p class="font-weight-light d-flex justify-content-end"><?= $salade->produit ?></p>
                                        <p class="font-weight-light d-flex justify-content-end"><?= $salade->boisson ?></p>
                                    </td>
                                    <td><?= $salade->quantite ?></td>
                                    <td><?= $salade->prix * $salade->quantite ?>€</td>
                                    <td>
                                        <a href="<?= $router->generate('Supprimer_du_panier') ?>?id=<?= $salade->id ?>">
                                            <button class="btn btn-sm btn-danger">supprimer</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            foreach ($menus as $menu) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $menu->nom ?>
                                        <p class="font-weight-light d-flex justify-content-end"><?= $menu->produit ?></p>
                                        <p class="font-weight-light d-flex justify-content-end"><?= $menu->accompagnement ?></p>
                                        <p class="font-weight-light d-flex justify-content-end"><?= $menu->boisson ?></p>
                                    </td>
                                    <td><?= $menu->quantite ?></td>
                                    <td><?= $menu->prix * $menu->quantite ?>€</td>
                                    <td>
                                        <a href="<?= $router->generate('Supprimer_du_panier') ?>?id=<?= $menu->id ?>">
                                            <button class="btn btn-sm btn-danger">supprimer</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            foreach ($menusEnfant as $menuEnfant) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $menuEnfant->nom ?>
                                        <p class="font-weight-light d-flex justify-content-end"><?= $menuEnfant->produit ?></p>
                                        <p class="font-weight-light d-flex justify-content-end"><?= $menuEnfant->accompagnement ?></p>
                                        <p class="font-weight-light d-flex justify-content-end"><?= $menuEnfant->boisson ?></p>
                                        <p class="font-weight-light d-flex justify-content-end"><?= $menuEnfant->dessert ?></p>
                                    </td>
                                    <td><?= $menuEnfant->quantite ?></td>
                                    <td><?= $menuEnfant->prix * $menuEnfant->quantite ?>€</td>
                                    <td>
                                        <a href="<?= $router->generate('Supprimer_du_panier') ?>?id=<?= $menuEnfant->id ?>">
                                            <button class="btn btn-sm btn-danger">supprimer</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            foreach ($menuEnfantNuggets as $menuEnfantNugget) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $menuEnfantNugget->nom ?>
                                        <p class="font-weight-light d-flex justify-content-end"><?= $menuEnfantNugget->produit ?></p>
                                        <p class="font-weight-light d-flex justify-content-end"><?= $menuEnfantNugget->accompagnement ?></p>
                                        <p class="font-weight-light d-flex justify-content-end"><?= $menuEnfantNugget->boisson ?></p>
                                        <p class="font-weight-light d-flex justify-content-end"><?= $menuEnfantNugget->dessert ?></p>
                                    </td>
                                    <td><?= $menuEnfantNugget->quantite ?></td>
                                    <td><?= $menuEnfantNugget->prix * $menuEnfantNugget->quantite ?>€</td>
                                    <td>
                                        <a href="<?= $router->generate('Supprimer_du_panier') ?>?id=<?= $menuEnfantNugget->id ?>">
                                            <button class="btn btn-sm btn-danger">supprimer</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            foreach ($plats as $plat) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $plat->nom ?>
                                    </td>
                                    <td><?= $plat->quantite ?></td>
                                    <td><?= $plat->prix * $plat->quantite ?>€</td>
                                    <td>
                                        <a href="<?= $router->generate('Supprimer_du_panier') ?>?id=<?= $plat->id ?>">
                                            <button class="btn btn-sm btn-danger">supprimer</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            foreach ($fritures as $friture) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $friture->nom ?>
                                    </td>
                                    <td><?= $friture->quantite ?></td>
                                    <td><?= $friture->prix * $friture->quantite ?>€</td>
                                    <td>
                                        <a href="<?= $router->generate('Supprimer_du_panier') ?>?id=<?= $friture->id ?>">
                                            <button class="btn btn-sm btn-danger">supprimer</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            foreach ($platsPerso as $platPerso) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $platPerso->nom ?>
                                        <p class="font-weight-light d-flex justify-content-end">Supplément: <?= $platPerso->supplement ?></p>
                                        <p class="font-weight-light d-flex justify-content-end">Ingrédient à retirer: <?= $platPerso->retrait ?></p>
                                    </td>
                                    <td><?= $platPerso->quantite ?></td>
                                    <td><?= $platPerso->prix * $platPerso->quantite ?>€</td>
                                    <td>
                                        <a href="<?= $router->generate('Supprimer_du_panier') ?>?id=<?= $platPerso->id ?>">
                                            <button class="btn btn-sm btn-danger">supprimer</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            foreach ($desserts as $dessert) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $dessert->nom ?>
                                    </td>
                                    <td><?= $dessert->quantite ?></td>
                                    <td><?= $dessert->prix * $dessert->quantite ?>€</td>
                                    <td>
                                        <a href="<?= $router->generate('Supprimer_du_panier') ?>?id=<?= $dessert->id ?>">
                                            <button class="btn btn-sm btn-danger">supprimer</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                        <?php
                        if ($total->total == 0) {
                        ?>

                        <?php
                        } else {
                        ?>
                            <tfoot class="bg-dark text-light">
                                <tr>
                                    <td></td>
                                    <td>Montant Total</td>
                                    <td><?= $total->total ?>€</td>
                                </tr>
                            </tfoot>
                        <?php
                        } ?>
                    </table>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="col-sm-12 offset-md-1 col-md-5">
            <div class="formulairePaiement mt-3">
                Le code du formulaire de paiement se trouvera ici
            </div>
        </div>
    </div>
</div>