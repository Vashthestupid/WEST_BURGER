<?php

// On récupère l'intégralité des salades

$select = "SELECT accompagnement.id, nomAccompagnement FROM accompagnement";

$req = $db->prepare($select);
$req->execute();

$accompagnements = array();

while($data = $req->fetchObject()){
    array_push($accompagnements,$data);
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
                            <th>Nom de l'accompagnement</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($accompagnements as $accompagnement) {
                        ?>
                            <tr>
                                <td><?= $accompagnement->id ?></td>
                                <td><?= $accompagnement->nomAccompagnement ?></td>
                                <td>
                                    <a href="<?= $router->generate('Voir_accompagnement')?>?id=<?=$accompagnement->id?>">
                                        <button class="btn btn-outline-dark">
                                            Voir
                                        </button>
                                    </a>
                                    <a href="<?= $router->generate('Editer_accompagnement')?>?id=<?=$accompagnement->id?>">
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
                    <a class="nav-link" href="/admin/accompagnements/Nouvel_accompagnement">Créer une nouvelle friture</a>
                </div>
            </div>
        </div>
    </div>
</div>