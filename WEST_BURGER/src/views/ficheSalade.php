<div class="container">
    <div class="row">
        <!-- Colonne NomProduit,imageProduit,prixProduit -->
        <div class="col-sm-12 offset-md-1 col-md-3 mt-3">
            <div class="informations">
                <h4 class="d-flex justify-content-center">Salade Fromagère</h4>
                <img class="w-75 ml-4" src="public/images/salade.png" alt="image salade">
            </div>
        </div>
        <!-- Colonne Description puis gestion de la commande  -->
        <div class="col-sm-12 offset-md-2 col-md-4">
            <div class="information mt-3">
                <h5 class="d-flex justify-content-center">Composition de la salade fromagère</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur vero rem molestias aut
                    quasi, odio iure corrupti architecto iusto vitae porro incidunt consequuntur quod quisquam
                    possimus distinctio! Unde, eaque quasi.</p>
                <form id="ajouter" method="post">
                    <div class="form-group">
                        <label class="d-flex" for="quantité">Quantité</label>
                        <input type="number" name="quantite" id="quantite">
                    </div>
                    <input type="number" name="id" value="1" hidden>
                    <input class=" boutonValider btn btn-secondary mb-3" type="submit" value="Ajouter au panier">
                </form>
            </div>
        </div>
    </div>
</div>