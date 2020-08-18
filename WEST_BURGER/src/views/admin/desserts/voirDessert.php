<?php

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}

// On récupère la totalité des desserts

$select = " SELECT dessert.id,nomDessert,prixDessert,imageDessert
FROM dessert
WHERE id = :id ";

$req = $db->prepare($select);
$req->bindParam(':id', $id);
$req->execute();

$dessert = $req->fetchObject();

// Si le bouton supprimé est cliqué

if (isset($_POST['delete'])) {

    $delete = "DELETE FROM dessert
    WHERE id = :idDessert";

    $reqDelete = $db->prepare($delete);
    $reqDelete->bindParam(':idDessert', $id);
    $reqDelete->execute();

    echo '<meta http-equiv="refresh" content="0;url=/admin/desserts"/>';
}

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom du dessert</th>
                            <th>Prix du dessert</th>
                            <th>Image du dessert</th>
                            <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $dessert->nomDessert ?></td>
                            <td><?= $dessert->prixDessert ?>€</td>
                            <td><img class="imagePlat" src="/public/images/<?= $dessert->imageDessert ?>" alt="Image de la friture"></td>
                            <td>
                                <form method="post">
                                    <a class="btn btn-sm btn-outline-dark" href="<?= $router->generate('Editer_dessert')?>?id=<?= $dessert->id?>">Editer</a>
                                    <input class="btn btn-sm btn-outline-dark" type="submit" value="Supprimer" name="delete">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="navigation">
                <a class="nav-link" href="/admin/desserts">Retour à la liste des desserts</a>
            </div>
        </div>
    </div>
</div>