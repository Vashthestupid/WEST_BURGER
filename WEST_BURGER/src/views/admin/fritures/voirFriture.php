<?php

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}

// On récupère la totalité des utilisateurs

$select = " SELECT friture.id,nomFriture,descFriture,prixFriture,imageFriture
FROM friture
WHERE id = :id ";

$req = $db->prepare($select);
$req->bindParam(':id', $id);
$req->execute();

$friture = $req->fetchObject();

// Si le bouton supprimé est cliqué

if (isset($_POST['delete'])) {

    $delete = "DELETE FROM friture
    WHERE id = :idFriture";

    $reqDelete = $db->prepare($delete);
    $reqDelete->bindParam(':idFriture', $id);
    $reqDelete->execute();

    echo '<meta http-equiv="refresh" content="0;url=/admin/fritures"/>';
}

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom de la friture</th>
                            <th>Description de la friture</th>
                            <th>Prix de la friture</th>
                            <th>Image de la friture</th>
                            <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $friture->nomFriture ?></td>
                            <td><?= $friture->descFriture ?></td>
                            <td><?= $friture->prixFriture ?>€</td>
                            <td><img class="imagePlat" src="/public/images/<?= $friture->imageFriture ?>" alt="Image de la friture"></td>
                            <td>
                                <form method="post">
                                    <a class="btn btn-sm btn-outline-dark" href="<?= $router->generate('Editer_friture')?>?id=<?= $friture->id?>">Editer</a>
                                    <input class="btn btn-sm btn-outline-dark" type="submit" value="Supprimer" name="delete">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="navigation">
                <a class="nav-link" href="/admin/fritures">Retour à la liste des fritures</a>
            </div>
        </div>
    </div>
</div>