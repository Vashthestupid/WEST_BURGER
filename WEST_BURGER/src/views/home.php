<?php

// On récupère le message en cas de suppression de compte

if (isset($_GET['message'])) {
    $message = htmlspecialchars(trim($_GET['message']));

    echo $message;
}

?>
<div class="container mt-2 mb-2">
    <div id="carouselExampleControls" class="carousel slide " data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="/public/images/image_burger.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class=" image-fluid d-block w-100" src="/public/images/image_salade.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="image-fluid d-block w-100" src="/public/images/image_dessert.jpg" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class=" images-fluid d-block w-100" src="/public/images/image_dessert2.jpg" alt="Fourth slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>