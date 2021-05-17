<?php

// On récupère l'id du produit à supprimer du panier

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $delete = "DELETE FROM panier
    WHERE id = :id";

    $req = $db->prepare($delete);
    $req->bindParam(':id', $id);
    $req->execute();

    echo '<meta http-equiv="refresh" content="0;url=/Panier"/>';
}
