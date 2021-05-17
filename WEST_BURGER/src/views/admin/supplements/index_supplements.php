
<?php

// On récupère l'intégralité des salades

$select = "SELECT supplements.id, nomSupplement FROM supplements";

$req = $db->prepare($select);
$req->execute();

$supplements = array();

while($data = $req->fetchObject()){
    array_push($supplements,$data);
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
                            <th>Nom du supplément</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($supplements as $supplement) {
                        ?>
                            <tr>
                                <td><?= $supplement->id ?></td>
                                <td><?= $supplement->nomSupplement ?></td>
                                <td>
                                    <a href="<?= $router->generate('Voir_supplement')?>?id=<?=$supplement->id?>">
                                        <button class="btn btn-outline-dark">
                                            Voir
                                        </button>
                                    </a>
                                    <a href="<?= $router->generate('Editer_supplement')?>?id=<?=$supplement->id?>">
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
                    <a class="nav-link" href="/admin/supplements/Nouveau_supplement">Créer un nouveau supplément</a>
                </div>
            </div>
        </div>
    </div>
</div>