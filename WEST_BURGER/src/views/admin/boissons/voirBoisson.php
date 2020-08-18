<?php

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}

// On récupère la totalité des utilisateurs

$select = " SELECT boisson.id,nomBoisson,prixBoisson
FROM boisson
WHERE id = :id ";

$req = $db->prepare($select);
$req->bindParam(':id', $id);
$req->execute();

$boisson = $req->fetchObject();

// Si le bouton supprimé est cliqué

if (isset($_POST['delete'])) {

    $delete = "DELETE FROM boisson
    WHERE id = :idBoisson";

    $reqDelete = $db->prepare($delete);
    $reqDelete->bindParam(':idBoisson', $id);
    $reqDelete->execute();

    echo '<meta http-equiv="refresh" content="0;url=/admin/boissons"/>';
}

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom de la boisson</th>
                            <th>Prix de la boisson</th>
                            <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $boisson->nomBoisson ?></td>
                            <td><?= $boisson->prixBoisson ?>€</td>
                            <td>
                                <form method="post">
                                    <a class="btn btn-sm btn-outline-dark" href="<?= $router->generate('Editer_boisson')?>?id=<?= $boisson->id?>">Editer</a>
                                    <input class="btn btn-sm btn-outline-dark" type="submit" value="Supprimer" name="delete">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="navigation">
                <a class="nav-link" href="/admin/boissons">Retour à la liste des boissons</a>
            </div>
        </div>
    </div>
</div>