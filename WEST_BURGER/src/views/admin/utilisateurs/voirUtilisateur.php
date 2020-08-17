<?php

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}

// On récupère la totalité des utilisateurs

$select = "SELECT utilisateur.id,nomUtilisateur,prenomUtilisateur,mailUtilisateur,typeutilisateur.nomTypeUtilisateur, telUtilisateur,adresseUtilisateur,codePostalUtilisateur,villeUtilisateur 
FROM utilisateur
INNER JOIN typeutilisateur ON utilisateur.typeutilisateur_id = typeutilisateur.id
WHERE utilisateur.id = :id";

$req = $db->prepare($select);
$req->bindParam(':id', $id);
$req->execute();

$utilisateur = $req->fetchObject();

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Mail</th>
                            <th>Type d'utilisateur</th>
                            <th>N° de téléphone</th>
                            <th>Adresse</th>
                            <th>Code Postal</th>
                            <th>Ville</th>
                            <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $utilisateur->nomUtilisateur ?></td>
                            <td><?= $utilisateur->prenomUtilisateur ?></td>
                            <td><?= $utilisateur->mailUtilisateur ?></td>
                            <td><?= $utilisateur->nomTypeUtilisateur ?></td>
                            <td><?= $utilisateur->telUtilisateur ?></td>
                            <td><?= $utilisateur->adresseUtilisateur ?></td>
                            <td><?= $utilisateur->codePostalUtilisateur ?></td>
                            <td><?= $utilisateur->villeUtilisateur ?></td>
                            <td>
                                <a href="<?= $router->generate('Editer_utilisateur') ?>?id=<?= $utilisateur->id ?>">
                                    <button class="btn btn-sm btn-outline-dark">
                                        Editer
                                    </button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="navigation">
                <a class="nav-link" href="/admin/utilisateurs">Retour à la liste des utilisateurs</a>
            </div>
        </div>
    </div>
</div>