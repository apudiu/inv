(function($){
    $(function(){
        /// initializing
        // sidenav
        $('.sidenav').sidenav();
        // material boxed (lightbox)
        $('.materialboxed').materialbox();
        // dropdown
        $('.dropdown-trigger').dropdown({
            // place dropdown below the dropdown trigger element
            coverTrigger: false
        });
        // selects
        $('.form-select').formSelect();
        // datepicker
        $('.datepicker').datepicker();

    }); // end of document ready
})(jQuery); // end of jQuery name space
