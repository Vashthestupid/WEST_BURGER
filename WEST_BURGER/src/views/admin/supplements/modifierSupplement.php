<?php

// On récupère l'identifiant du produit

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}

// On récupère les information du produit en fonction de l'identifiant récupéré 

$select = "SELECT * FROM supplements WHERE id = :id";

$req = $db->prepare($select);
$req->bindParam(':id', $id);
$req->execute();

$supplement = $req->fetchObject();


// Si le bouton valider est cliqué alors on modifie les champs en fonction de l'identifiant

if (isset($_POST['valider'])) {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $image = htmlspecialchars(trim($_POST['prix']));

    $modifier = "UPDATE supplements 
    SET nomSupplement = :nom,
    imageSupplement = :image
    WHERE supplements.id = :idSupplement";

    $reqModifier = $db->prepare($modifier);
    $reqModifier->bindParam(':nom', $nom);
    $reqModifier->bindParam(':image', $image);
    $reqModifier->bindParam(':idSupplement', $id);
    $reqModifier->execute();

    echo '<meta http-equiv="refresh" content="0;url=/admin/supplements"/>';
}


?>
<div class="container">
    <div id="editTypeUser" class="offset-md-2 col-md-8">
        <h2 class=" titleForm d-flex justify-content-center">Modifier un supplément</h2>
        <form method="post" class="mt-5">
            <div class="form-group">
                <label for="nom" class="d-flex justify-content-center">Nom du supplément</label>
                <input class="form-inline d-flex mx-auto w-75" type="text" name="nom" id="nom" value="<?= $supplement->nomSupplement ?>">
            </div>
            <div class="form-group">
                <label for="prix" class="d-flex justify-content-center">Image du supplément</label>
                <input class="form-inline d-flex mx-auto w-75" type="file" name="image" id="image" value="<?= $supplement->imageSupplement ?>">
            </div>
            <input type="submit" name="valider" value="Valider" class="btn btn-outline-dark d-flex mx-auto justify-content-center w-25 mb-5">
        </form>
    </div>
</div>