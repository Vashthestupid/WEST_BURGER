<div class="container">
    <div class="row">
        <!-- Colonne NomProduit,imageProduit,prixProduit -->
        <div class="col-sm-12 offset-md-1 col-md-3 mt-3">
            <div class="informations">
                <h4 class="d-flex justify-content-center">West Burger</h4>
                <img class="w-75 ml-4" src="../../public/images/burger.png" alt="image burger">
                <p class="d-flex justify-content-center">Prix: 20€</p>
            </div>
        </div>
        <!-- Colonne Description puis gestion de la commande  -->
        <div class="col-sm-12 offset-md-2 col-md-4">
            <div class="information mt-3">
                <h5 class="d-flex justify-content-center">Composition du burger</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur vero rem molestias aut
                    quasi, odio iure corrupti architecto iusto vitae porro incidunt consequuntur quod quisquam
                    possimus distinctio! Unde, eaque quasi.</p>
                <form id="ajouter" method="post">
                    <div class="form-group">
                        <label for="quantité">Quantité</label>
                        <input type="number" name="quantite" id="quantite">
                    </div>
                    <input type="number" name="id" value="1" hidden>
                    <input class=" boutonValider btn btn-secondary mb-3" type="submit" value="Ajouter au panier">
                </form>
                <button id="personnaliser" class="open d-flex mx-auto mb-3">
                    Personnaliser
                </button>
                <form class="suppléments mt-3 mb-3" method="post">
                    <div class="form-group">
                        <label class="d-flex" for="supplement1">Supplément</label>
                        <select name="suppplement1" id="supplement">
                            <option>Choix d'un supplément</option>
                            <option value="viande">Viande + 1,50€</option>
                            <option value="sauce">Sauce + 0,50€</option>
                            <option value="viande">Fromage + 1,00€</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="d-flex" for="supplement1">Si vous souhaitez retirer un ou des ingrédient(s) veuillez l'indiquer ci-dessous.</label>
                        <input type="text" name="enlever" id="enlever">
                    </div>

                    <div class="form-group">
                        <label class="d-flex" for="quantite">Quantité</label>
                        <input type="number" name="quantite" id="quantite">
                    </div>

                    <input class="boutonValider btn btn-secondary" type="submit" value="Ajouter au panier">
                </form>
            </div>
        </div>
    </div>
</div>