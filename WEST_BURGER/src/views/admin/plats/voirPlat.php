<?php

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}

// On récupère la totalité des utilisateurs

$select = " SELECT plat.id, nomPlat,descPlat,prixPlat,imagePlat 
FROM plat
WHERE id = :id  ";

$req = $db->prepare($select);
$req->bindParam(':id', $id);
$req->execute();

$plat = $req->fetchObject();

// Si le bouton supprimé est cliqué

if(isset($_POST['delete'])){

    $delete = "DELETE FROM plat 
    WHERE id = :idPlat";

    $reqDelete = $db->prepare($delete);
    $reqDelete->bindParam(':idPlat', $id);
    $reqDelete->execute();

    echo '<meta http-equiv="refresh" content="0;url=/admin/plats"/>';

}

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom du plat</th>
                            <th>Description du plat</th>
                            <th>Prix du plat</th>
                            <th>Image du plat</th>
                            <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $plat->nomPlat ?></td>
                            <td><?= $plat->descPlat ?></td>
                            <td><?= $plat->prixPlat ?>€</td>
                            <td><img class="imagePlat" src="/public/images/<?= $plat->imagePlat ?>" alt="Image du plat"></td>
                            <td>
                                <form method="post">
                                    <a class="btn btn-sm btn-outline-dark" href="<?= $router->generate('Editer_plat') ?>?id=<?= $plat->id ?>">Editer</a>
                                    <input class="btn btn-sm btn-outline-dark" type="submit" value="Supprimer" name="delete">
                                </form>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="navigation">
                <a class="nav-link" href="/admin/plats">Retour à la liste des utilisateurs</a>
            </div>
        </div>
    </div>
</div>