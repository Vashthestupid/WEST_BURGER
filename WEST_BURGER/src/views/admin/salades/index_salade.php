<?php

// On récupère l'intégralité des salades

$select = "SELECT salade.id, nomSalade FROM salade";

$req = $db->prepare($select);
$req->execute();

$salades = array();

while($data = $req->fetchObject()){
    array_push($salades,$data);
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
                            <th>Nom de la salade</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($salades as $salade) {
                        ?>
                            <tr>
                                <td><?= $salade->id ?></td>
                                <td><?= $salade->nomSalade ?></td>
                                <td>
                                    <a href="<?= $router->generate('Voir_salade')?>?id=<?=$salade->id?>">
                                        <button class="btn btn-outline-dark">
                                            Voir
                                        </button>
                                    </a>
                                    <a href="<?= $router->generate('Editer_salade')?>?id=<?=$salade->id?>">
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
                    <a class="nav-link" href="/admin/salades/Nouvelle_salade">Créer une nouvelle salade</a>
                </div>
            </div>
        </div>
    </div>
</div>