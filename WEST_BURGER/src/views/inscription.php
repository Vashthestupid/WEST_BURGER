<?php

// Inscription

if (isset($_POST['valider'])) {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['emailInsc']));
    $mdp = htmlspecialchars(trim($_POST['mdp']));
    $mdp2 = htmlspecialchars(trim($_POST['mdp2']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $adresse = htmlspecialchars(trim($_POST['adresse']));
    $cp = htmlspecialchars(trim($_POST['cp']));
    $ville = htmlspecialchars(trim($_POST['ville']));

    // Si les mots de passe ont la même valeur

    if ($mdp2 === $mdp) {
        $mdp3 = password_hash(htmlspecialchars(trim($mdp)), PASSWORD_BCRYPT);

        // On verifie si l'email n'est pas déjà utilisé
        $selectUserExiste = "SELECT COUNT(mailUtilisateur) as nb
				FROM utilisateur 
				WHERE mailUtilisateur = :mailUser";

        $reqSelectUserExiste = $db->prepare($selectUserExiste);
        $reqSelectUserExiste->bindParam(':mailUser', $email);
        $reqSelectUserExiste->execute();

        $nb = $reqSelectUserExiste->fetchObject();

        if($nb->nb == 0){

            $insert = "INSERT INTO utilisateur(nomUtilisateur,prenomUtilisateur,mailUtilisateur,mdpUtilisateur,telUtilisateur,adresseUtilisateur,codePostalUtilisateur,villeUtilisateur)
            VALUES(:nom,:prenom,:mail,:mdp,:tel,:adresse,:cp,:ville)";

            $req = $db->prepare($insert);
            $req->bindParam(':nom',$nom);
            $req->bindParam(':prenom',$prenom);
            $req->bindParam(':mail',$email);
            $req->bindParam(':mdp',$mdp3);
            $req->bindParam(':tel',$telephone);
            $req->bindParam(':adresse',$adresse);
            $req->bindParam(':cp',$cp);
            $req->bindParam(':ville',$ville);
            $req->execute();

            echo "Votre inscription a bien été effectuée";

        } else {
            echo "L'email est déjà utilisé";
        }
    } else {
        echo "Les mots de passes ne correspondent pas";
    }
}

?>
<div class="d-flex justify-content-center mt-5">
    <button id="btnInscription" type="button" class="btn btn-sm btn-secondary mr-3">Inscription</button>
    <button id="btnConnexion" type="button" class="btn btn-sm btn-secondary">Connexion</button>
</div>
<br>

<div id="connexion" class="offset-md-2 col-md-8">
    <h4 class=" titleForm d-flex justify-content-center col-sm-12">Formulaire de connexion</h4>
    <form action="index.php" method='post' id="formConnexion" class="mt-5">
        <div class="form-group">
            <label for="email" class="d-flex justify-content-center">Email</label>
            <input class="form-inline d-flex mx-auto w-75" type="email" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="mdp" class="d-flex justify-content-center">Mot de passe</label>
            <input class="form-inline d-flex mx-auto w-75" type="password" name="mdp" id="mdp">
        </div>
        <input type="submit" name="login" value="Valider" class="btn btn-success d-flex mx-auto">
    </form>
</div>

<div id="inscription" class="offset-md-2 col-md-8">
    <h4 class=" titleForm d-flex justify-content-center col-sm-12">Formulaire d'inscription</h4>
    <form method="post" class="offset-md-2 col-md-8 mt-5">
        <div class="form-group">
            <label for="nom" class="d-flex justify-content-center">Nom</label>
            <input class="form-inline d-flex mx-auto w-75" type="text" name="nom" id="nom">
        </div>
        <div class="form-group">
            <label for="prenom" class="d-flex justify-content-center">Prenom</label>
            <input class="form-inline d-flex mx-auto w-75" type="text" name="prenom" id="prenom">
        </div>
        <div class="form-group">
            <label for="email" class="d-flex justify-content-center">Email</label>
            <input class="form-inline d-flex mx-auto w-75" type="email" name="emailInsc" id="emailInsc">
        </div>
        <div class="form-group">
            <label for="mdp" class="d-flex justify-content-center">Mot de passe</label>
            <input class="form-inline d-flex mx-auto w-75" type="password" name="mdp" id="mdp">
        </div>
        <div class="form-group">
            <label for="mdp" class="d-flex justify-content-center">Confirmation du mot de passe</label>
            <input class="form-inline d-flex mx-auto w-75" type="password" name="mdp2" id="mdp2">
        </div>

        <div class="form-group">
            <label for="telephone" class="d-flex justify-content-center">N° de téléphone</label>
            <input class="form-inline d-flex mx-auto w-75" type="tel" name="telephone" id="telephone">
        </div>
        <div class="form-group">
            <label for="adresse" class="d-flex justify-content-center">Adresse</label>
            <input class="form-inline d-flex mx-auto w-75" type="text" name="adresse" id="adresse">
        </div>
        <div class="form-group">
            <label for="cp" class="d-flex justify-content-center">Code Postal</label>
            <input class="form-inline d-flex mx-auto w-75" type="text" name="cp" id="cp">
        </div>
        <div class="form-group">
            <label for="ville" class="d-flex justify-content-center">Ville</label>
            <input class="form-inline d-flex mx-auto w-75" type="text" name="ville" id="ville">
        </div>
        <input type="submit" name="valider" value="Valider" class="btn btn-success d-flex mx-auto mb-5">
    </form>
</div>