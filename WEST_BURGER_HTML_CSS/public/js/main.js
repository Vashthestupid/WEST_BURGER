$(document).ready(function(){

    // Faire apparaître le sous menu
    $('#lien_sous_menu').click(function(){
        $('#sous_menu').toggle();
    })

    // Faire apparaître un formulaire au clic 
    $('#btnInscription').click(function(){
        $('#inscription').show();
        $('#connexion').hide();
        // Changer la couleur des boutons en fonction de
        // celui qui est actif
        $('#btnInscription').removeClass('btn-secondary');
        $('#btnInscription').addClass('btn-primary');
        $('#btnConnexion').removeClass('btn-primary');
        $('#btnConnexion').addClass('btn-secondary');
    })

    $('#btnConnexion').click(function(){
        $('#connexion').show();
        $('#inscription').hide();
        // Changer la couleur des boutons en fonction de
        // celui qui est actif
        $('#btnConnexion').removeClass('btn-secondary');
        $('#btnConnexion').addClass('btn-primary');
        $('#btnInscription').removeClass('btn-primary');
        $('#btnInscription').addClass('btn-secondary');
    })
})