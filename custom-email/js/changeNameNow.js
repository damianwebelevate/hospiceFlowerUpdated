jQuery(document).ready(function($){

    function validateEmail(sEmail) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,6})+$/;
        if (regex.test(sEmail)) {
            console.log(true);
            return true;
        }
        else {
            console.log(false);
            return false;
        }
    };

    

});
