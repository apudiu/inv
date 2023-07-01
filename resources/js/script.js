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

    // functions

    /**
     * Calculates invoice entries total & places in Grand total
     * @param gTotalValueElemId
     * @param totalElemClass
     */
    window.calculateGTotal = function (gTotalValueElemId, totalElemClass) {

        // g total elem
        let gtElem = $(gTotalValueElemId);

        // all rows total
        let sum = 0;
        $(totalElemClass).map((index, item) => {

            let n = parseInt(item.innerText);

            if (n > 0) {
                sum += n;
            }
        });

        gtElem.text(sum);
    };

    /**
     * Converts an HTML element to PDF with styling &
     * download that as a PDF file.
     * @param elementId string  id of the element that need to be converted to PDF
     * @param fileName  string  File that will be used when downloading the PDF
     */
    window.printElement = function (elementId, fileName) {

        // element that will be printed/converted
        let element = document.getElementById(elementId);

        // printing options
        let opt = {
            margin:       1,
            filename:     fileName + '.pdf',
            image:        {
                type: 'jpeg',
                quality: 1
            },
            html2canvas:  {
                scale: 2
            },
            jsPDF:        {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };


        // Promise-based usage:
        let pdf = html2pdf().set(opt).from(element);

        // converting to pdf file
        pdf.save();

    };

})(jQuery); // end of jQuery name space
