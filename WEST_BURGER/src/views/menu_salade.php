<?php

// On récupère la liste des salades

$select = "SELECT salade.id, nomSalade  FROM salade";

$req = $db->prepare($select);
$req->execute();

$salades = array();

while ($data = $req->fetchObject()) {
    array_push($salades, $data);
}

// On récupère la liste des boissons

$selectBoisson = "SELECT boisson.id, nomBoisson FROM boisson";

$reqBoisson = $db->prepare($selectBoisson);
$reqBoisson->execute();

$boissons = array();

while ($data = $reqBoisson->fetchObject()) {
    array_push($boissons, $data);
}

// On ajoute le produit dans la table Menu_Salade
if ($_SESSION['login']) {
    if (isset($_POST['valider'])) {
        $salade = intval($_POST['plat']);
        $boisson = intval($_POST['boisson']);
        $dessert = intval($_POST['dessert']);
        $quantite  = intval($_POST['quantite']);

        // On insère d'abord dans la table menu salade

        $insert = "INSERT INTO menusalade(salade_id,boisson_id) VALUES(:salade,:boisson)";

        $reqInsert = $db->prepare($insert);
        $reqInsert->bindParam(':salade', $salade);
        $reqInsert->bindParam(':boisson', $boisson);
        $reqInsert->execute();

        // Maintenant on récupère le dernier id inséré
        $lastInsertIdMenuSalade = $db->lastInsertId();

        // On récupère le prix du menu

        $selectPrix = "SELECT prix FROM menusalade WHERE id = :lastInsert";

        $reqPrix = $db->prepare($selectPrix);
        $reqPrix->bindParam(':lastInsert', $lastInsertIdMenuSalade);
        $reqPrix->execute();

        $prixMenu = $reqPrix->fetchObject();
        $prix = $prixMenu->prix;

        // Puis on l'insère dans la table panier
        $insertPanier = "INSERT INTO panier(menusalade_id,utilisateur_id,quantite,prix,dateCommande) VALUES(:menuSalade,:idUser,:quantite,:prix,NOW())";

        $insertPanier = $db->prepare($insertPanier);
        $insertPanier->bindParam(':menuSalade', $lastInsertIdMenuSalade);
        $insertPanier->bindParam(':idUser', $_SESSION['user']);
        $insertPanier->bindParam(':quantite', $quantite);
        $insertPanier->bindParam(':prix', $prix);
        $insertPanier->execute();

        echo 'Le produit a bien été ajouté au panier';
    }
} else {
    echo "Vous devez être connecté pour mettre un produit au panier";
}
?>
<div class="container">
    <div class="row">
        <!-- Colonne NomProduit,imageProduit,prixProduit -->
        <div class="col-sm-12 offset-md-1 col-md-3 mt-3">
            <div class="informations">
                <h4 class="d-flex justify-content-center">Menu Salade</h4>
                <img class="w-75 ml-4" src="public/images/salade.png" alt="image menu Salade">
                <p class="d-flex justify-content-center">Prix: 10€</p>
            </div>
        </div>
        <!-- Colonne Description puis gestion de la commande  -->
        <div class="col-sm-12 offset-md-2 col-md-4">
            <div class="information mt-3">
                <h5 class="d-flex justify-content-center">Contenu du menu salade</h5>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Mollitia, vitae quisquam. Fugit, necessitatibus, deserunt cumque nobis accusamus magni facilis, est vero iusto illum veritatis nulla? Obcaecati laborum dolorum aut vitae!</p>
                <form id="ajouter" method="post">
                    <div class="form-group">
                        <label class="d-flex" for="burger">Choisissez votre salade</label>
                        <select name="plat" id="plat">
                            <option>Salades</option>
                            <?php
                            foreach ($salades as $salade) {
                            ?>
                                <option value="<?= $salade->id ?>"><?= $salade->nomSalade ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="d-flex" for="boisson">Choisissez votre boisson</label>
                        <select name="boisson" id="boisson">
                            <option>Boisson</option>
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
                    <input class="btn btn-secondary mb-5" type="submit" name="valider" value="Ajouter">
                </form>
            </div>
        </div>
    </div>
</div>