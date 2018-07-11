/**
 * Created by moridrin on 5-12-16.
 */
jQuery(function ($) {
    $(document).ready(function () {
        function calculatePageMinHeight() {
            let navHeight = $('nav#menu').height();
            let footerHeight = $('#page-footer').height();
            let adminBarHeight = $('#wpadminbar').height();
            let heightOtherElements = Math.round(navHeight + footerHeight + adminBarHeight + 40);
            $('#page').css('min-height', 'calc(100vh - ' + heightOtherElements + 'px)');
        }
        calculatePageMinHeight();
        $( window ).resize(function() {
            calculatePageMinHeight();
        });

        antiSpamReplace();

        let $slider = jQuery('.lt-slider');
        let sliderHeight = $slider.height();
        $slider.slider({full_width: true, indicators: false, interval: parseInt(theme_vars.slider_interval)});
        jQuery(window).resize(function() {
            $slider.height(Math.min(Math.round(0.5 * jQuery(window).height()) + 15, sliderHeight)).css('position', 'relative');
            jQuery('.lt-slider .js_overlay').height(Math.min(Math.round(0.5 * jQuery(window).height()) + 15, sliderHeight));
        });
        jQuery(window).trigger('resize');
        // Init SideNav
        $('.button-collapse').sidenav({
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
        $('.modal').modal({
            ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
                var contentHolder = modal.find(".ajax-getter");
                if (contentHolder.text() === '') {
                    var url = contentHolder.data('url');
                    contentHolder.css('text-align', 'center');
                    contentHolder.html('<div style="display: inline-block;"><div class="preloader-wrapper active"><div class="spinner-layer spinner-red-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div></div>');
                    $.ajax({
                        url: '/?modal-ajax-url=' + url,
                        type: 'GET',
                        crossDomain: true,
                        dataType: 'html',
                        success: function (data) {
                            contentHolder.css('text-align', '');
                            contentHolder.html(data);
                        },
                        error: function () {
                            contentHolder.css('text-align', '');
                            contentHolder.html('An error occurred.');
                        }
                    });
                }
            },
        });

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
        $('select').formSelect();

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

    $(document).ready(function () {
        $('.tooltipped').tooltip({html: true});
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

function antiSpamReplace() {
    jQuery(function ($) {
        $('[data-anti-spam-tag]').each(function () {
            let $this = $(this);
            let tag = $this.attr('data-anti-spam-tag');
            let emailBeforeAt = $this.attr('data-before-at');
            let emailAfterAt = $this.attr('data-after-at');
            let mailto = $this.attr('data-mailto');
            $this.attr(tag, mailto+emailBeforeAt+'@'+emailAfterAt);
            $this.removeAttr('data-before-at');
            $this.removeAttr('data-after-at');
            $this.removeAttr('data-mailto');
            $this.removeAttr('data-anti-spam-tag');
        });
        $('span[data-before-at][data-after-at]').each(function () {
            let $this = $(this);
            console.log(this);
            let emailBeforeAt = $this.attr('data-before-at');
            let emailAfterAt = $this.attr('data-after-at');
            $this.replaceWith(emailBeforeAt+'@'+emailAfterAt);
        });
    });
}
