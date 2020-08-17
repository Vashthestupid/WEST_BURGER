<div class="container">
    <div class="row">
        <!-- Colonne NomProduit,imageProduit,prixProduit -->
        <div class="col-sm-12 offset-md-1 col-md-3 mt-3">
            <div class="informations">
                <h4 class="d-flex justify-content-center">Menu XL</h4>
                <img class="w-75 ml-4" src="../../public/images/menu.png" alt="image menu">
                <p class="d-flex justify-content-center">Prix: 8,99€</p>
            </div>
        </div>
        <!-- Colonne Description puis gestion de la commande  -->
        <div class="col-sm-12 offset-md-2 col-md-4">
            <div class="information mt-3">
                <h5 class="d-flex justify-content-center">Contenu du menu</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                <form id="ajouter" method="post">
                    <div class="form-group">
                        <label class="d-flex" for="burger">Choisissez votre burger</label>
                        <select name="burger" id="burger">
                            <option>Votre burger</option>
                            <option value="west burger">West Burger</option>
                            <option value="CheeseBurger">CheeseBurger</option>
                            <option value="west burger">Hamburger</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="d-flex" for="boisson">Choisissez votre boisson</label>
                        <select name="boisson" id="boisson">
                            <option>Votre boisson</option>
                            <option value="coca">Coca Cola</option>
                            <option value="fanta_orange">Fanta orange</option>
                            <option value="fanta_citron">Fanta citron</option>
                            <option value="ice_tea_peche">Ice tea Pêche</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="d-flex" for="quantite">Quantité</label>
                        <input type="number" name="quantite" id="quantite">
                    </div>
                    <input class="btn btn-secondary" type="submit" value="Ajouter">
                </form>
            </div>
            <button id="personnaliser" class="d-flex mx-auto mb-3 mt-2">Personnaliser</button>
            <form class="suppléments">
                <div class="form-group">
                    <label class="d-flex" for="burger">Choisissez votre burger</label>
                    <select name="burger" id="burger">
                        <option>Votre burger</option>
                        <option value="west burger">West Burger</option>
                        <option value="CheeseBurger">CheeseBurger</option>
                        <option value="west burger">Hamburger</option>
                    </select>
                </div>
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
                    <label class="d-flex" for="fromages">Choix du fromage</label>
                    <select name="fromage" id="fromage">
                        <option>Choix du fromage</option>
                        <option value="raclette">Raclette + 0,50€</option>
                        <option value="cheddar">Cheddar + 1,00€</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="d-flex" for="viande">Choix de la viande</label>
                    <select name="fromage" id="fromage">
                        <option>Choisir le type de viande</option>
                        <option value="boeuf">Boeuf + 2,50€</option>
                        <option value="poulet">Poulet + 2,00€</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="d-flex" for="boisson">Choisissez votre boisson</label>
                    <select name="boisson" id="boisson">
                        <option>Votre boisson</option>
                        <option value="coca">Coca Cola</option>
                        <option value="fanta_orange">Fanta orange</option>
                        <option value="fanta_citron">Fanta citron</option>
                        <option value="ice_tea_peche">Ice tea Pêche</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="d-flex" for="quantite">Quantité</label>
                    <input type="number" name="quantite" id="quantite">
                </div>
                <input class="btn btn-secondary mb-3" type="submit" value="Ajouter">
            </form>
        </div>
    </div>
</div>