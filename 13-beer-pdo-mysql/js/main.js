$(function(){

// Faire une pop-up pour confirmer la suppression des brasseries après clic sur boutons qui ont la class confirm-delete

    $('.confirm-delete').on('click', function (event) {
        event.preventDefault();
        var button = this; // ou event.currentTarget
        //plug-in sweet alert :
        swal({
            title: 'Etes-vous sûr(e) de vouloir supprimer cette brasserie ?',
            text: 'Vous ne pourrez plus jamais goûter leurs bières...',
            icon: 'warning',
            buttons: true,
            dangerMode: true
        }).then(function (hasConfirm){
            if(hasConfirm) {  //si on confirme la suppression => on clique sur le vrai bouton pour supprimer
                window.location = $(button).attr('href'); //on redirige vers le vrai lien de suppression
            }
        });  
    });


    //pour réutiliser le this dans le then, on peut utiliser les fonctions fléchées


});//end of document ready 

