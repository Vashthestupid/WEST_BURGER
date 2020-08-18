
<?php

// On récupère l'intégralité des salades

$select = "SELECT boisson.id, nomBoisson FROM boisson";

$req = $db->prepare($select);
$req->execute();

$boissons = array();

while($data = $req->fetchObject()){
    array_push($boissons,$data);
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
                            <th>Nom de la boisson</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($boissons as $boisson) {
                        ?>
                            <tr>
                                <td><?= $boisson->id ?></td>
                                <td><?= $boisson->nomBoisson ?></td>
                                <td>
                                    <a href="<?= $router->generate('Voir_boisson')?>?id=<?=$boisson->id?>">
                                        <button class="btn btn-outline-dark">
                                            Voir
                                        </button>
                                    </a>
                                    <a href="<?= $router->generate('Editer_boisson')?>?id=<?=$boisson->id?>">
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
                    <a class="nav-link" href="/admin/boissons/Nouvelle_boisson">Créer une nouvelle boisson</a>
                </div>
            </div>
        </div>
    </div>
</div>