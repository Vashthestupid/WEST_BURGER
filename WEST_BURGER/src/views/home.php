<div class="container">
    <?php
        if(!$_SESSION['login']){
            echo "";
        } else {
            echo "Bonjour " .$_SESSION['prenom'];
        }
    ?>
    <div class="row">
        <h1 id='intro' class="mt-3 d-flex justify-content-center">Bienvenue sur notre site</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 offset-md-1 col-md-4">
            <p>Ici vous pourrez commander ce qui vous fait envie.
                De plus chez nous la livraison est gratuite :D.
            </p>
        </div>
    </div>
</div>