<?php

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}

// On récupère la totalité des utilisateurs

$select = " SELECT salade.id, nomSalade,descSalade,prixSalade,imageSalade
FROM salade
WHERE id = :id  ";

$req = $db->prepare($select);
$req->bindParam(':id', $id);
$req->execute();

$salade = $req->fetchObject();

// Si le bouton supprimé est cliqué

if (isset($_POST['delete'])) {

    $delete = "DELETE FROM salade 
    WHERE id = :idSalade";

    $reqDelete = $db->prepare($delete);
    $reqDelete->bindParam(':idSalade', $id);
    $reqDelete->execute();

    echo '<meta http-equiv="refresh" content="0;url=/admin/salades"/>';
}

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom de la salade</th>
                            <th>Description de la salade</th>
                            <th>Prix de la salade/th>
                            <th>Image de la salade</th>
                            <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $salade->nomSalade ?></td>
                            <td><?= $salade->descSalade ?></td>
                            <td><?= $salade->prixSalade ?>€</td>
                            <td><img class="imagePlat" src="/public/images/<?= $salade->imageSalade ?>" alt="Image de la salade"></td>
                            <td>
                                <form method="post">
                                    <a class="btn btn-sm btn-outline-dark" href="<?= $router->generate('Editer_salade') ?>?id=<?= $salade->id ?>">Editer</a>
                                    <input class="btn btn-sm btn-outline-dark" type="submit" value="Supprimer" name="delete">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="navigation">
                <a class="nav-link" href="/admin/salades">Retour à la liste des salades</a>
            </div>
        </div>
    </div>
</div>