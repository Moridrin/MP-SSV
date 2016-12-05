/**
 * Created by moridrin on 5-12-16.
 */
jQuery(function ($) {
    $(document).ready(function () {
        // Init SideNav
        $('.button-collapse').sideNav({
                closeOnClick: true,
                draggable: true
            }
        );

        // Init DatePicker
        $('input[type=date]').pickadate({
            selectMonths: true,
            selectYears: true,
            format: 'yyyy-mm-dd',
            firstDay: 1
            // More Options: http://amsul.ca/pickadate.js/date/
        });

        // Init Parallax
        $('.parallax').parallax();
    });
});