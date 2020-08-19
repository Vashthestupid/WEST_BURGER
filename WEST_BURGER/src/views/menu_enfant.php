<?php

// On récupère la liste des plats

$selectPlat = "SELECT plat.id, nomPlat as nom FROM plat WHERE nomPlat = 'Hamburger'
UNION 
SELECT plat.id, nomPlat as nom FROM plat WHERE nomPLat = 'Croque'
UNION
SELECT friture.id, nomFriture as nom FROM friture WHERE nomFriture = 'Nuggets'";

$reqPlat = $db->prepare($selectPlat);
$reqPlat->execute();

$plats = array();

while($data = $reqPlat->fetchObject()){
    array_push($plats,$data);
}

// On récupère la liste des accompagnements

$selectAccommpagnement = "SELECT accompagnement.id, nomAccompagnement FROM accompagnement";

$reqAccompagnement = $db->prepare($selectAccommpagnement);
$reqAccompagnement->execute();

$accompagnements = array();

while ($data = $reqAccompagnement->fetchObject()) {
    array_push($accompagnements, $data);
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
                                <option value="<?= $accompagnement->id?>"><?= $accompagnement->nomAccompagnement?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="d-flex" for="quantite">Quantité</label>
                        <input type="number" name="quantite" id="quantite">
                    </div>
                    <input class="btn btn-secondary" type="submit" value="Ajouter">
                </form>
            </div>
        </div>
    </div>
</div>