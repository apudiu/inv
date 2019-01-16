(function($){
    $(function(){
        // initializing sidenav
        $('.sidenav').sidenav();

        // initializing dropdown
        $(".dropdown-trigger").dropdown({
            coverTrigger: false
        });

    }); // end of document ready
})(jQuery); // end of jQuery name space
