<?php

// On ajoute le produit

if(isset($_POST['valider'])){
    $nom = htmlspecialchars(trim($_POST['nom']));
    $desc = htmlspecialchars(trim($_POST['desc']));
    $prix = intval($_POST['prix']);
    $image = htmlspecialchars(trim($_POST['image']));

    // On verifie si le produit n'existe pas déjà

    $existe = "SELECT COUNT(nomSalade) AS nb FROM salade";

    $reqExiste = $db->prepare($existe);
    $reqExiste->execute();

    $nb = $reqExiste->fetchObject();

    // Si le produit n'existe pas alors on l'insére dans la base
    if($nb->nb == 0){
        
        $insert = "INSERT INTO salade(nomSalade,descSalade,prixSalade,imageSalade) VALUES(:nom,:desc,:prix,:image)";

        $req = $db->prepare($insert);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':desc', $desc);
        $req->bindParam(':prix', $prix);
        $req->bindParam(':image', $image);
        $req->execute();
        
        // header('Location: /admin/plats');
        echo '<meta http-equiv="refresh" content="0;url=/admin/salades"/>';

    } else {
        echo "Le produit existe déjà";
    }
}


?>
<div class="container">
    <div id="editTypeUser" class="offset-md-2 col-md-8">
        <h2 class=" titleForm d-flex justify-content-center">Ajouter une salade</h2>
        <form method="post" class="mt-5">
            <div class="form-group">
                <label for="nom" class="d-flex justify-content-center">Nom de la salade</label>
                <input class="form-inline d-flex mx-auto w-75" type="text" name="nom" id="nom">
            </div>
            <div class="form-group">
                <label for="desc" class="d-flex justify-content-center">Description de la salade</label>
                <textarea class="form-inline d-flex mx-auto w-75"  name="desc" id="desc" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="prix" class="d-flex justify-content-center">Prix de la salade</label>
                <input class="form-inline d-flex mx-auto w-75"  type="number" name="prix" id="prix">
            </div>
            <div class="form-group">
                <label for="prix" class="d-flex justify-content-center">Image de la salade</label>
                <input class="form-inline d-flex mx-auto w-75"  type="file" name="image" id="image">
            </div>
            <input type="submit" name="valider" value="Valider" class="btn btn-outline-dark d-flex mx-auto justify-content-center w-25 mb-5">
        </form>
    </div>
</div>