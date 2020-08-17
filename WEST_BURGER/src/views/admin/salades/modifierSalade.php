<?php

// On récupère les informations du produit

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
}

$selectInfo = "SELECT * FROM salade WHERE id = :id";

$reqInfo = $db->prepare($selectInfo);
$reqInfo->bindParam(':id', $id);
$reqInfo->execute();

$salade = $reqInfo->fetchObject();

// Modifier le produit

if(isset($_POST['valider'])){
    $nom = htmlspecialchars(trim($_POST['nom']));
    $desc = htmlspecialchars(trim($_POST['desc']));
    $prix = intval($_POST['prix']);
    $image = htmlspecialchars(trim($_POST['image']));

    $modifier = "UPDATE salade
    SET nomSalade = :nom,
    prixSalade = :prix,
    descSalade = :desc,
    imageSalade = :image
    WHERE id = :idSalade";

    $reqModifier = $db->prepare($modifier);
    $reqModifier->bindParam(':nom', $nom);
    $reqModifier->bindParam(':desc', $desc);
    $reqModifier->bindParam(':prix', $prix);
    $reqModifier->bindParam(':image', $image);
    $reqModifier->bindParam(':idSalade', $id);
    $reqModifier->execute();

    echo '<meta http-equiv="refresh" content="0;url=/admin/salades"/>';
}

?>
<div class="container">
    <div id="editTypeUser" class="offset-md-2 col-md-8">
        <h2 class=" titleForm d-flex justify-content-center">Modifier une salade</h2>
        <form method="post" class="mt-5">
            <div class="form-group">
                <label for="nom" class="d-flex justify-content-center">Nom de la salade</label>
                <input class="form-inline d-flex mx-auto w-75" type="text" name="nom" id="nom" value="<?= $salade->nomSalade?>">
            </div>
            <div class="form-group">
                <label for="desc" class="d-flex justify-content-center">Description de la salade</label>
                <textarea class="form-inline d-flex mx-auto w-75"  name="desc" id="desc" cols="30" rows="10" ><?= $salade->descSalade ?></textarea>
            </div>
            <div class="form-group">
                <label for="prix" class="d-flex justify-content-center">Prix de la salade</label>
                <input class="form-inline d-flex mx-auto w-75"  type="number" name="prix" id="prix" value="<?= $salade->prixSalade ?>">
            </div>
            <div class="form-group">
                <label for="prix" class="d-flex justify-content-center">Image de la salade</label>
                <input class="form-inline d-flex mx-auto w-75"  type="file" name="image" id="image">
            </div>
            <input type="submit" name="valider" value="Valider" class="btn btn-outline-dark d-flex mx-auto justify-content-center w-25 mb-5">
        </form>
    </div>
</div>