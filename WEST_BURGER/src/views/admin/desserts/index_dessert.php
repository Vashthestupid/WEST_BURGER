
<?php

// On récupère l'intégralité des salades

$select = "SELECT dessert.id, nomDessert FROM dessert";

$req = $db->prepare($select);
$req->execute();

$desserts = array();

while($data = $req->fetchObject()){
    array_push($desserts,$data);
}

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 offset-md-3 col-md-5">
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom du dessert</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($desserts as $dessert) {
                        ?>
                            <tr>
                                <td><?= $dessert->id ?></td>
                                <td><?= $dessert->nomDessert ?></td>
                                <td>
                                    <a href="<?= $router->generate('Voir_dessert')?>?id=<?=$dessert->id?>">
                                        <button class="btn btn-outline-dark">
                                            Voir
                                        </button>
                                    </a>
                                    <a href="<?= $router->generate('Editer_dessert')?>?id=<?=$dessert->id?>">
                                        <button class="btn btn-outline-dark">
                                            Editer
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="navigation">
                    <a class="nav-link" href="/admin/desserts/Nouveau_dessert">Créer un nouveau dessert</a>
                </div>
            </div>
        </div>
    </div>
</div>