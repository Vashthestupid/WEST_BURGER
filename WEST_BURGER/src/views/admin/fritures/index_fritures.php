<?php

// On récupère l'intégralité des salades

$select = "SELECT friture.id, nomFriture FROM friture";

$req = $db->prepare($select);
$req->execute();

$fritures = array();

while($data = $req->fetchObject()){
    array_push($fritures,$data);
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
                            <th>Nom de la friture</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($fritures as $friture) {
                        ?>
                            <tr>
                                <td><?= $friture->id ?></td>
                                <td><?= $friture->nomFriture ?></td>
                                <td>
                                    <a href="<?= $router->generate('Voir_friture')?>?id=<?=$friture->id?>">
                                        <button class="btn btn-outline-dark">
                                            Voir
                                        </button>
                                    </a>
                                    <a href="<?= $router->generate('Editer_friture')?>?id=<?=$friture->id?>">
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
                    <a class="nav-link" href="/admin/fritures/Nouvelle_friture">Créer une nouvelle friture</a>
                </div>
            </div>
        </div>
    </div>
</div>