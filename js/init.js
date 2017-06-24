/**
 * Created by moridrin on 5-12-16.
 */
jQuery(function ($) {
    $(document).ready(function () {

        /*var image_banner = $('img.banner');
        $(window).resize(function () {
            image_banner.height(image_banner.width() / 4);
        });
        image_banner.height(image_banner.width() / 4);*/
        jQuery('.lt-slider').slider({full_width: true, indicators: false});
        jQuery(window).resize(function() {
            jQuery('.lt-slider').height(Math.min(Math.round(0.75 * jQuery(window).height()) + 15,450)).css('position', 'relative');
        });
        jQuery(window).trigger('resize');
        // Init SideNav
        $('.button-collapse').sideNav({
                closeOnClick: true,
                draggable: true
            }
        );

        // Init DatePicker
        var datePickers = $('input[type=date]');
        datePickers.each(function () {
            var dateAfter = $(this).attr('dateAfter');
            var minDate = dateAfter ? dateAfter : '';
            var dateBefore = $(this).attr('dateBefore');
            var maxDate = dateBefore ? dateBefore : '';
            $(this).pickadate({
                selectMonths: true,
                selectYears: 100,
                mask: '9999-19-39',
                format: 'yyyy-mm-dd',
                close: '',
                onSet: function (ele) {
                    if (ele.select) {
                        this.close();
                    }
                },
                firstDay: 1,
                min: minDate,
                max: maxDate
                // More Options: http://amsul.ca/pickadate.js/date/
            });
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
        if (typeof widgetAreaOffset !== 'undefined') {
            var offset = widgetAreaOffset.top;
            $(window).on("scroll", function () {
                setWidgetAreaState(offset);
            });
            setWidgetAreaState(offset);
        }

        $('.collapsible').collapsible();

    });
});

function setWidgetAreaState(offset) {
    jQuery(function ($) {
        var page = $("#page");
        var wrap = $(".widget-area");
        if ($(window).scrollTop() > offset - 25) {
            wrap.addClass("fixed");
            page.css("min-height", "100vh");
        } else {
            wrap.removeClass("fixed");
        }
    });
}
