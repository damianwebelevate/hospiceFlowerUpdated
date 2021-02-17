jQuery(document).ready(function($) {

    $('.chooseFlower').on('click', function(evt){
        evt.preventDefault();
        let ident = this.id;
        console.log("clicked");
        alert(ident);
    });

});
