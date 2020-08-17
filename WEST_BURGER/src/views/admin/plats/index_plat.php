<?php

// On récupère l'id et le nom du plat

$select = "SELECT plat.id, nomPlat FROM plat ORDER BY plat.id DESC";

$req = $db->prepare($select);
$req->execute();

$plats = array();

while($data = $req->fetchObject()){
    array_push($plats,$data);
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
                            <th>Nom du plat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($plats as $plat) {
                        ?>
                            <tr>
                                <td><?= $plat->id ?></td>
                                <td><?= $plat->nomPlat ?></td>
                                <td>
                                    <a href="<?= $router->generate('Voir_plat')?>?id=<?=$plat->id?>">
                                        <button class="btn btn-outline-dark">
                                            Voir
                                        </button>
                                    </a>
                                    <a href="<?= $router->generate('Editer_plat')?>?id=<?=$plat->id?>">
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
                    <a class="nav-link" href="/admin/plats/Nouveau_plat">Créer un nouveau plat</a>
                </div>
            </div>
        </div>
    </div>
</div>