<?php

// On ajoute le produit

if(isset($_POST['valider'])){
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prix = intval($_POST['prix']);
    $image = htmlspecialchars(trim($_POST['image']));

    // On verifie si le produit n'existe pas déjà

    $existe = "SELECT COUNT(nomAccompagnement) AS nb FROM accompagnement WHERE nomAccompagnement = :nomAccompagnement";

    $reqExiste = $db->prepare($existe);
    $reqExiste->bindParam('nomAccompagnement', $nom);
    $reqExiste->execute();

    $nb = $reqExiste->fetchObject();

    // Si le produit n'existe pas alors on l'insére dans la base
    if($nb->nb == 0){
        
        $insert = "INSERT INTO accompagnement(nomAccompagnement,prixAccompagnement,imageAccompagnement) VALUES(:nom,:prix,:image)";

        $req = $db->prepare($insert);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prix', $prix);
        $req->bindParam(':image', $image);
        $req->execute();
        
        // header('Location: /admin/plats');
        echo '<meta http-equiv="refresh" content="0;url=/admin/accompagnements"/>';

    } else {
        echo "Le produit existe déjà";
    }
}


?>
<div class="container">
    <div id="editTypeUser" class="offset-md-2 col-md-8">
        <h2 class=" titleForm d-flex justify-content-center">Ajouter un accompagnement</h2>
        <form method="post" class="mt-5">
            <div class="form-group">
                <label for="nom" class="d-flex justify-content-center">Nom de l'accompagnement</label>
                <input class="form-inline d-flex mx-auto w-75" type="text" name="nom" id="nom">
            </div>
            <div class="form-group">
                <label for="prix" class="d-flex justify-content-center">Prix de l'accompagnement</label>
                <input class="form-inline d-flex mx-auto w-75"  type="number" name="prix" id="prix">
            </div>
            <div class="form-group">
                <label for="prix" class="d-flex justify-content-center">Image de l'accompagnement</label>
                <input class="form-inline d-flex mx-auto w-75"  type="file" name="image" id="image">
            </div>
            <input type="submit" name="valider" value="Valider" class="btn btn-outline-dark d-flex mx-auto justify-content-center w-25 mb-5">
        </form>
    </div>
</div>