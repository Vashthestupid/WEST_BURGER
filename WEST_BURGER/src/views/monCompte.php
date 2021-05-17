<?php

// On récupère les messages s'il y en a 

if (isset($_GET['message'])) {
    $message = htmlspecialchars(trim($_GET['message']));

    echo $message;
}

// On récupère les informations de la personne en fonction de la session

$select = "SELECT * FROM utilisateur WHERE utilisateur.id = :id";

$req = $db->prepare($select);
$req->bindParam(':id', $_SESSION['user']);
$req->execute();

$user = $req->fetchObject();

// On modifie les données de l'utilisateur

if (isset($_POST['valider'])) {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $tel = htmlspecialchars(trim($_POST['telephone']));
    $adresse = htmlspecialchars(trim($_POST['adresse']));
    $cp = htmlspecialchars(trim($_POST['cp']));
    $ville = htmlspecialchars(trim($_POST['ville']));


    $modifier = "UPDATE utilisateur
        SET nomUtilisateur = :nom,
        prenomUtilisateur = :prenom,
        telUtilisateur = :tel,
        adresseUtilisateur = :adresse,
        codePostalUtilisateur = :cp,
        villeUtilisateur = :ville
        WHERE utilisateur.id = :idUtilisateur";

    $reqModifier = $db->prepare($modifier);
    $reqModifier->bindParam(':nom', $nom);
    $reqModifier->bindParam(':prenom', $prenom);
    $reqModifier->bindParam(':tel', $tel);
    $reqModifier->bindParam(':adresse', $adresse);
    $reqModifier->bindParam(':cp', $cp);
    $reqModifier->bindParam(':ville', $ville);
    $reqModifier->bindParam(':idUtilisateur', $_SESSION['user']);
    $reqModifier->execute();

    echo '<meta http-equiv="refresh" content="0;url=/Mon_compte"/>';
}

// Modification de l'adresse email

if (isset($_POST['modifier'])) {
    $mailActuel = htmlspecialchars(trim($_POST['mailActuel']));
    $mail = htmlspecialchars(trim($_POST['mail']));

    // On verifie si l'ancienne adresse email est bien la votre

    if ($mailActuel != $user->mailUtilisateur) {
        echo "L'adresse email que vous avez rentré n'est pas la même que celle enregistrée";
    } else {
        if ($mail != $mailActuel) {
            // On verfie si l'adresse email n'est pas déjà utilisé
            $selectExiste = "SELECT COUNT(mailUtilisateur) as nb FROM utilisateur WHERE mailUtilisateur = :mailUtilisateur";

            $reqSelectExiste = $db->prepare($selectExiste);
            $reqSelectExiste->bindParam(':mailUtilisateur', $mail);
            $reqSelectExiste->execute();

            $nb = $reqSelectExiste->fetchObject();

            if ($nb->nb == 0) {
                $modifierMail = "UPDATE utilisateur
                SET mailUtilisateur = :mail
                WHERE utilisateur.id = :idUser";

                $reqModifierMail = $db->prepare($modifierMail);
                $reqModifierMail->bindParam(':mail', $mail);
                $reqModifierMail->bindParam(':idUser', $_SESSION['user']);
                $reqModifierMail->execute();

                echo '<meta http-equiv="refresh" content="0;url=/Mon_compte?message=Votre adresse email a bien été modifiée"/>';
            } else {
                echo '<meta http-equiv="refresh" content="0;url=/Mon_compte?message=L\'email que vous souhaitez enregistrer existe déjà dans notre base de données"/>';
            }
        } else {
            echo '<meta http-equiv="refresh" content="0;url=/Mon_compte?message=L\'adresse email que vous essayez d\'enregistrer est la même que celle présente dans notre base de données."/>';
        }
    }
}

// Modification du mot de passe

if (isset($_POST['modifierMDP'])) {
    $mdp = htmlspecialchars(trim($_POST['ancienMDP']));
    $mdp2 = htmlspecialchars(trim($_POST['newMDP']));
    $mdp3 = htmlspecialchars(trim($_POST['confMDP']));

    // On verifie si le premier mot de passe est bien celui présent en base de données

    $mdpActuel = $user->mdpUtilisateur;

    $mdpVerifie = password_verify($mdp, $mdpActuel);

    if ($mdpVerifie) {
        if ($mdp2 == $mdp3) {
            $mdp4 = password_hash(htmlspecialchars(trim($mdp2)), PASSWORD_BCRYPT);

            $modifierMDP = "UPDATE utilisateur
            SET mdpUtilisateur = :mdp
            WHERE utilisateur.id = :idUserMDP";

            $reqModifierMDP = $db->prepare($modifierMDP);
            $reqModifierMDP->bindParam(':mdp', $mdp4);
            $reqModifierMDP->bindParam(':idUserMDP', $_SESSION['user']);
            $reqModifierMDP->execute();

            echo '<meta http-equiv="refresh" content="0;url=/Mon_compte?message=Votre mot de passe a bien été modifié"/>';
        } else {
            echo "Les 2 mots de passe entrés ne sont pas les mêmes";
        }
    } else {
        echo "Le mot de passe que vous avez indiqué n'est pas celui présent en base de données";
    }
}

// Si le bouton supprimer mon compte est cliqué

if (isset($_POST['delete'])) {
    
    $supprimer = "DELETE FROM utilisateur
    WHERE utilisateur.id = :idUserSupp";

    $reqSupprimer = $db->prepare($supprimer);
    $reqSupprimer->bindParam(':idUserSupp', $_SESSION['user']);
    $reqSupprimer->execute();

    session_destroy();

    echo '<meta http-equiv="refresh" content="0;url=/?message=Votre compte a bien été supprimé"/>';
}


?>
<div class="container">
    <h3 class="d-flex justify-content-center mt-3">Mon compte</h3>
    <div class="row">
        <div class="col-sm-12 col-md-6 mt-5">
            <h6 class="d-flex justify-content-center">Mes informations personnelles</h6>
            <div id="informations">
                <ul>
                    <li>Nom : <?= $user->nomUtilisateur ?></li>
                    <li>Prenom : <?= $user->prenomUtilisateur ?></li>
                    <li>Téléphone : <?= $user->telUtilisateur ?></li>
                    <li>Adresse : <?= $user->adresseUtilisateur ?></li>
                    <li>Code Postal : <?= $user->codePostalUtilisateur ?></li>
                    <li>Ville : <?= $user->villeUtilisateur ?></li>
                </ul>
            </div>
            <div class="row mb-5">
                <button id="btnModifier" class="btn btn-primary w-50">Modifier mes informations</button>
                <button id="btnModifierMail" class="btn btn-secondary w-50">Modifier mon email</button>
                <button id="btnMDP" class="btn btn-warning w-50">Modifier mon mot de passe</button>
                <form method="post" class="form w-50">
                    <input id="btnSupp" type="submit" value="Supprimer mon compte" name="delete" class="btn btn-danger w-100">
                </form>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 mt-5" id="modifierInformations">
            <form method="post">
                <div class="form-group">
                    <label for="nom" class="d-flex justify-content-center">Nom</label>
                    <input class="form-inline d-flex mx-auto w-75" type="text" name="nom" id="nom" value="<?= $user->nomUtilisateur ?>">
                </div>
                <div class="form-group">
                    <label for="prenom" class="d-flex justify-content-center">Prenom</label>
                    <input class="form-inline d-flex mx-auto w-75" type="text" name="prenom" id="prenom" value="<?= $user->prenomUtilisateur ?>">
                </div>
                <div class="form-group">
                    <label for="telephone" class="d-flex justify-content-center">N° de téléphone</label>
                    <input class="form-inline d-flex mx-auto w-75" type="tel" name="telephone" id="telephone" value="<?= $user->telUtilisateur ?>">
                </div>
                <div class="form-group">
                    <label for="adresse" class="d-flex justify-content-center">Adresse</label>
                    <input class="form-inline d-flex mx-auto w-75" type="text" name="adresse" id="adresse" value="<?= $user->adresseUtilisateur ?>">
                </div>
                <div class="form-group">
                    <label for="cp" class="d-flex justify-content-center">Code Postal</label>
                    <input class="form-inline d-flex mx-auto w-75" type="text" name="cp" id="cp" value="<?= $user->codePostalUtilisateur ?>">
                </div>
                <div class="form-group">
                    <label for="ville" class="d-flex justify-content-center">Ville</label>
                    <input class="form-inline d-flex mx-auto w-75" type="text" name="ville" id="ville" value="<?= $user->villeUtilisateur ?>">
                </div>
                <input type="submit" name="valider" value="Valider" class="btn btn-outline-secondary d-flex justify-content-center mx-auto w-50 mb-5">
            </form>
        </div>
        <div id="modifierMail" class="col-sm-12 col-md-6 mt-5">
            <form method="post">
                <div class="form-group">
                    <label for="email" class="d-flex justify-content-center">Adresse email actuelle</label>
                    <input class="form-inline d-flex mx-auto w-75" type="email" name="mailActuel" id="mailActuel">
                </div>
                <div class="form-group">
                    <label for="email" class="d-flex justify-content-center">Nouvelle adresse email</label>
                    <input class="form-inline d-flex mx-auto w-75" type="email" name="mail" id="mail">
                </div>

                <input type="submit" name="modifier" value="Valider" class="btn btn-outline-secondary d-flex justify-content-center mx-auto w-50 mb-5">
            </form>
        </div>
        <div id="modifierMDP" class="col-sm-12 col-md-6 mt-5">
            <form method="post">
                <div class="form-group">
                    <label for="ancienMDP" class="d-flex justify-content-center">Votre mot de passe actuel</label>
                    <input class="form-inline d-flex mx-auto w-75" type="password" name="ancienMDP" id="ancienMDP">
                </div>
                <div class="form-group">
                    <label for="ancienMDP" class="d-flex justify-content-center">Votre nouveau mot de passe</label>
                    <input class="form-inline d-flex mx-auto w-75" type="password" name="newMDP" id="newMDP">
                </div>
                <div class="form-group">
                    <label for="ancienMDP" class="d-flex justify-content-center">Confirmez votre nouveau mot de passe</label>
                    <input class="form-inline d-flex mx-auto w-75" type="password" name="confMDP" id="confMDP">
                </div>
                <input type="submit" name="modifierMDP" value="Valider" class="btn btn-outline-secondary d-flex justify-content-center mx-auto w-50 mb-5">
            </form>
        </div>
    </div>
</div>