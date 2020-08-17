<?php

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}

// On récupère les données de la table typeUtilisateur
$select = "SELECT * FROM typeutilisateur";

$req = $db->prepare($select);
$req->execute();

$roles = array();

while ($data = $req->fetchObject()) {
    array_push($roles, $data);
}

// On modifie le type de l'utilisateur

if (isset($_POST['valider'])) {
    $role = intval($_POST['role']);

    $update = "UPDATE utilisateur 
    SET utilisateur.typeutilisateur_id = :role
    WHERE utilisateur.id = :id";

    $reqUpdate = $db->prepare($update);
    $reqUpdate->bindParam(':role', $role);
    $reqUpdate->bindParam(':id', $id);
    $reqUpdate->execute();

    echo "Le role a bien été modifié";
}
?>
<div class="container">
    <div id="editTypeUser" class="offset-md-2 col-md-8">
        <h2 class=" titleForm d-flex justify-content-center">Modifier le role l'utilisateur</h2>
        <form method="post" class="mt-5">
            <div class="form-group">
                <label for="nomType" class="d-flex justify-content-center">Rôle de l'utilisateur</label>
                <select class="d-flex mx-auto w-75" name="role" id="role">
                    <?php
                    foreach ($roles as $role) {
                    ?>
                        <option value="<?= $role->id ?>"><?= $role->nomTypeUtilisateur ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <input type="submit" name="valider" value="Valider" class="btn btn-outline-dark d-flex mx-auto justify-content-center w-25">
        </form>
    </div>
</div>