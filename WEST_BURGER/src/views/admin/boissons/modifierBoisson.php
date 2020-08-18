<?php

// On récupère l'identifiant du produit

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}

// On récupère les information du produit en fonction de l'identifiant récupéré 

$select = "SELECT * FROM boisson WHERE id = :id";

$req = $db->prepare($select);
$req->bindParam(':id', $id);
$req->execute();

$boisson = $req->fetchObject();


// Si le bouton valider est cliqué alors on modifie les champs en fonction de l'identifiant

if (isset($_POST['valider'])) {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prix = intval($_POST['prix']);

    $modifier = "UPDATE boisson 
    SET nomBoisson = :nom,
    prixBoisson = :prix
    WHERE boisson.id = :idBoisson";

    $reqModifier = $db->prepare($modifier);
    $reqModifier->bindParam(':nom', $nom);
    $reqModifier->bindParam(':prix', $prix);
    $reqModifier->bindParam(':idBoisson', $id);
    $reqModifier->execute();

    echo '<meta http-equiv="refresh" content="0;url=/admin/boissons"/>';
}


?>
<div class="container">
    <div id="editTypeUser" class="offset-md-2 col-md-8">
        <h2 class=" titleForm d-flex justify-content-center">Modifier une boisson</h2>
        <form method="post" class="mt-5">
            <div class="form-group">
                <label for="nom" class="d-flex justify-content-center">Nom de la boisson</label>
                <input class="form-inline d-flex mx-auto w-75" type="text" name="nom" id="nom" value="<?= $boisson->nomBoisson ?>">
            </div>
            <div class="form-group">
                <label for="prix" class="d-flex justify-content-center">Prix de la boisson</label>
                <input class="form-inline d-flex mx-auto w-75" type="number" name="prix" id="prix" value="<?= $boisson->prixBoisson ?>">
            </div>
            <input type="submit" name="valider" value="Valider" class="btn btn-outline-dark d-flex mx-auto justify-content-center w-25 mb-5">
        </form>
    </div>
</div>