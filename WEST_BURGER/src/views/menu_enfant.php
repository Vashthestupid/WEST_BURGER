<div class="container">
    <div class="row">
        <!-- Colonne NomProduit,imageProduit,prixProduit -->
        <div class="col-sm-12 offset-md-1 col-md-3 mt-3">
            <div class="informations">
                <h4 class="d-flex justify-content-center">Menu Enfant</h4>
                <img class="w-75 ml-4" src="public/images/menu_enfant.png" alt="image menu enfant">
                <p class="d-flex justify-content-center">Prix: 8,99€</p>
            </div>
        </div>
        <!-- Colonne Description puis gestion de la commande  -->
        <div class="col-sm-12 offset-md-2 col-md-4">
            <div class="information mt-3">
                <h5 class="d-flex justify-content-center">Contenu du menu enfant</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                <form id="ajouter" method="post">
                    <div class="form-group">
                        <label class="d-flex" for="burger">Choisissez votre plat</label>
                        <select name="plat" id="plat">
                            <option>Plat</option>
                            <option value="CheeseBurger">CheeseBurger</option>
                            <option value="croque">Croque</option>
                            <option value="Nuggets">Nuggets</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="d-flex" for="boisson">Frites ou potatoes</label>
                        <select name="accompagnement" id="accompagnement">
                            <option>Accompagnement</option>
                            <option value="frites">Frites</option>
                            <option value="potatoes">Potatoes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="d-flex" for="quantite">Quantité</label>
                        <input type="number" name="quantite" id="quantite">
                    </div>
                    <input class="btn btn-secondary" type="submit" value="Ajouter">
                </form>
            </div>
        </div>
    </div>
</div>