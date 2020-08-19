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

// On récupère la liste des desserts

$selectDessert = "SELECT dessert.id, nomDessert FROM dessert";

$reqDessert = $db->prepare($selectDessert);
$reqDessert->execute();

$desserts = array();

while ($data = $reqDessert->fetchObject()) {
    array_push($desserts, $data);
}

?>
<div class="container">
    <div class="row">
        <!-- Colonne NomProduit,imageProduit,prixProduit -->
        <div class="col-sm-12 offset-md-1 col-md-3 mt-3">
            <div class="informations">
                <h4 class="d-flex justify-content-center">Menu Salade</h4>
                <img class="w-75 ml-4" src="public/images/salade.png" alt="image menu Salade">
                <p class="d-flex justify-content-center">Prix: 4€</p>
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
                        <label class="d-flex" for="boisson">Choisissez votre boisson</label>
                        <select name="boisson" id="boisson">
                            <option>Dessert</option>
                            <?php
                            foreach ($desserts as $dessert) {
                            ?>
                                <option value="<?= $dessert->id ?>"><?= $dessert->nomDessert ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="d-flex" for="quantite">Quantité</label>
                        <input type="number" name="quantite" id="quantite">
                    </div>
                    <input class="btn btn-secondary mb-5" type="submit" value="Ajouter">
                </form>
            </div>
        </div>
    </div>
</div>