/**
 * Created by moridrin on 5-12-16.
 */
jQuery(function ($) {
    $(document).ready(function () {
        $('a.materialboxed-trigger').on('click', function () {
            event.preventDefault();
            $('#' + this.dataset.imgId).show().trigger('click');
        })
    });
});
