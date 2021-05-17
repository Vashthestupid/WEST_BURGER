<?php

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}

// On récupère la totalité des utilisateurs

$select = " SELECT supplements.id,nomSupplement,imageSupplement
FROM supplements
WHERE id = :id ";

$req = $db->prepare($select);
$req->bindParam(':id', $id);
$req->execute();

$supplement = $req->fetchObject();

// Si le bouton supprimé est cliqué

if (isset($_POST['delete'])) {

    $delete = "DELETE FROM supplements
    WHERE id = :idSupplement";

    $reqDelete = $db->prepare($delete);
    $reqDelete->bindParam(':idSupplement', $id);
    $reqDelete->execute();

    echo '<meta http-equiv="refresh" content="0;url=/admin/supplement"/>';
}

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom du supplement</th>
                            <th>Image du supplement</th>
                            <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $supplement->nomSupplement ?></td>
                            <td><img class="imagePlat" src="/public/images/<?= $supplement->imageSupplement ?>" alt="Image du supplement"></td>
                            <td>
                                <form method="post">
                                    <a class="btn btn-sm btn-outline-dark" href="<?= $router->generate('Editer_supplement') ?>?id=<?= $supplement->id ?>">Editer</a>
                                    <input class="btn btn-sm btn-outline-dark" type="submit" value="Supprimer" name="delete">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="navigation">
                <a class="nav-link" href="/admin/supplements">Retour à la liste des supplements</a>
            </div>
        </div>
    </div>
</div>