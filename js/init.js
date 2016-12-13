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
        var date = new Date();
        $('input[type=date]').pickadate({
            selectMonths: true,
            selectYears: 30,
            format: 'yyyy-mm-dd',
            firstDay: 1,
            min: new Date(date.getFullYear() - 30, date.getMonth(), date.getDay()),
            max: date
            // More Options: http://amsul.ca/pickadate.js/date/
        });

        // Init Parallax
        $('.parallax').parallax();
        $('.modal').modal();

        $('.pushpin-demo-nav').each(function () {
            var $this = $(this);
            var $target = $('#' + $(this).attr('data-target'));
            $this.pushpin({
                top: $target.offset().top,
                bottom: $target.offset().top + $target.outerHeight() - $this.height()
            });
        });

        // Init Tabs
        $('ul.tabs').tabs();

        // Init Select
        $('select').material_select();

        var offset = jQuery(".widget-area").offset().top;
        $(window).on("scroll", function () {
            setWidgetAreaState(offset);
        });
        setWidgetAreaState(offset);
    });
});

function setWidgetAreaState(offset)
{
    var wrap = jQuery(".widget-area");
    if (jQuery(window).scrollTop() > offset - 25) {
        wrap.addClass("fixed");
    } else {
        wrap.removeClass("fixed");
    }
}