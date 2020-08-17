<?php
// On récupère la totalité des utilisateurs

$select = "SELECT  utilisateur.id,nomUtilisateur,prenomUtilisateur FROM utilisateur ORDER BY utilisateur.id DESC";

$req = $db->prepare($select);
$req->execute();

$utilisateurs = array();

while ($data = $req->fetchObject()) {
    array_push($utilisateurs, $data);
}

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 offset-md-3 col-md-5">
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($utilisateurs as $utilisateur) {
                        ?>
                            <tr>
                                <td><?= $utilisateur->nomUtilisateur ?></td>
                                <td><?= $utilisateur->prenomUtilisateur ?></td>
                                <td>
                                    <a href="<?= $router->generate('Voir_utilisateur')?>?id=<?=$utilisateur->id?>">
                                        <button class="btn btn-outline-dark">
                                            Voir
                                        </button>
                                    </a>
                                    <a href="<?= $router->generate('Editer_utilisateur')?>?id=<?=$utilisateur->id?>">
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
            </div>
        </div>
    </div>
</div>