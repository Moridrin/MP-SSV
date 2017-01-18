/**
 * Created by moridrin on 5-12-16.
 */
jQuery(function ($) {
    $(document).ready(function () {

        var image_banner = $('img.banner');
        $(window).resize(function() {
            image_banner.height(image_banner.width() / 4);
        });
        image_banner.height(image_banner.width() / 4);

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
            mask: '9999-19-39',
            format: 'yyyy-mm-dd',
            closeOnSelect: true,
            close: '',
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

        var widgetAreaOffset = jQuery(".widget-area").offset();
        if (typeof widgetAreaOffset != 'undefined') {
            var offset = widgetAreaOffset.top;
            $(window).on("scroll", function () {
                setWidgetAreaState(offset);
            });
            setWidgetAreaState(offset);
        }

        $('.collapsible').collapsible();
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