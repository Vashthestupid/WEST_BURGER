$(document).ready(function () {

    // Faire apparaître le sous menu
    $('#lien_sous_menu').click(function () {
        $('#sous_menu').toggle();
    })

    // Faire apparaître un formulaire au clic 
    $('#btnInscription').click(function () {
        $('#inscription').show();
        $('#connexion').hide();
        // Changer la couleur des boutons en fonction de
        // celui qui est actif
        $('#btnInscription').removeClass('btn-secondary');
        $('#btnInscription').addClass('btn-primary');
        $('#btnConnexion').removeClass('btn-primary');
        $('#btnConnexion').addClass('btn-secondary');
    })

    $('#btnConnexion').click(function () {
        $('#connexion').show();
        $('#inscription').hide();
        // Changer la couleur des boutons en fonction de
        // celui qui est actif
        $('#btnConnexion').removeClass('btn-secondary');
        $('#btnConnexion').addClass('btn-primary');
        $('#btnInscription').removeClass('btn-primary');
        $('#btnInscription').addClass('btn-secondary');
    })

    // Sur la page fiche produit le bouton plus affichera le formulaire de suppléments et fera disparaître le bouton valider

    var personnaliser = '<button id="personnaliser" class="open d-flex mx-auto mb-3"> Personnaliser </button>'
    var fermer = '<button id="fermer" class=" d-flex mx-auto mb-3"> Fermer </button>'

    $('#personnaliser').click(function(){
        $('.suppléments').show();
        $('#ajouter').hide();
        $(this).replaceWith(fermer);
        $('#fermer').click(function(){
            $('#ajouter').show();
            $('.suppléments').hide();
            $(this).replaceWith(" ");
        })
    })

})