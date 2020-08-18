<?php

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}

// On récupère la totalité des utilisateurs

$select = " SELECT accompagnement.id,nomAccompagnement,prixAccompagnement,imageAccompagnement
FROM accompagnement
WHERE id = :id ";

$req = $db->prepare($select);
$req->bindParam(':id', $id);
$req->execute();

$accompagnement = $req->fetchObject();

// Si le bouton supprimé est cliqué

if (isset($_POST['delete'])) {

    $delete = "DELETE FROM accompagnement
    WHERE id = :idAccompagnement";

    $reqDelete = $db->prepare($delete);
    $reqDelete->bindParam(':idAccompagnement', $id);
    $reqDelete->execute();

    echo '<meta http-equiv="refresh" content="0;url=/admin/accompagnements"/>';
}

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom de l'accompagnement</th>
                            <th>Prix de l'accompagnement</th>
                            <th>Image de l'accompagnement</th>
                            <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $accompagnement->nomAccompagnement ?></td>
                            <td><?= $accompagnement->prixAccompagnement ?>€</td>
                            <td><img class="imagePlat" src="/public/images/<?= $accompagnement->imageAccompagnement ?>" alt="Image de la friture"></td>
                            <td>
                                <form method="post">
                                    <a class="btn btn-sm btn-outline-dark" href="<?= $router->generate('Editer_accompagnement')?>?id=<?= $accompagnement->id?>">Editer</a>
                                    <input class="btn btn-sm btn-outline-dark" type="submit" value="Supprimer" name="delete">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="navigation">
                <a class="nav-link" href="/admin/accompagnements">Retour à la liste des accompagnements</a>
            </div>
        </div>
    </div>
</div>