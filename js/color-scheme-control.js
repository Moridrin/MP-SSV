/* global colorScheme, Color */
/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */

(function(api) {
    var cssTemplate = wp.template('mpssv-color-scheme'),
        colorSchemeKeys = [
            'default_color',
            'default_color_light_1',
            'default_color_dark_1',
            'default_color_light_2',
            'default_color_dark_2',
            'accent_color',
            'accent_color_light',
            'accent_color_dark',
            'background2_color',
            'menu_header_color',
            'entry_header_color',
            'main_text_color',
            'secondary_text_color',
            'header_text_color',
            'link_color',
            'light_text_color',
            'danger_color',
            'danger_color_light',
            'danger_color_dark',
            'footer_color',
        ],
        colorSettings = [
            'default_color',
            'default_color_light_1',
            'default_color_dark_1',
            'default_color_light_2',
            'default_color_dark_2',
            'accent_color',
            'accent_color_light',
            'accent_color_dark',
            'background2_color',
            'menu_header_color',
            'entry_header_color',
            'main_text_color',
            'secondary_text_color',
            'header_text_color',
            'link_color',
            'light_text_color',
            'danger_color',
            'danger_color_light',
            'danger_color_dark',
            'footer_color',
        ];

    api.controlConstructor.select = api.Control.extend({
        ready: function() {
            if ('color_scheme' === this.id) {
                this.setting.bind('change', function(value) {
                    var colors = colorScheme[value].colors;

                    // Update Default Color.
                    var color = colors[0];
                    api('default_color').set(color);
                    api.control('default_color').container.find('.color-picker-hex')
                        .data('data-default-color', color)
                        .wpColorPicker('defaultColor', color);

                    // Update Default Color Light 1.
                    var color = colors[1];
                    api('default_color_light_1').set(color);
                    api.control('default_color_light_1').container.find('.color-picker-hex')
                        .data('data-default-color-light-1', color)
                        .wpColorPicker('defaultColorLight1', color);

                    // Update Default Color Dark 1 Color.
                    var color = colors[2];
                    api('default_color_dark_1').set(color);
                    api.control('default_color_dark_1').container.find('.color-picker-hex')
                        .data('data-default-color-dark-1', color)
                        .wpColorPicker('defaultColorDark1', color);

                    // Update Default Color Light 2 Color.
                    var color = colors[3];
                    api('default_color_light_2').set(color);
                    api.control('default_color_light_2').container.find('.color-picker-hex')
                        .data('data-default-color-light-2', color)
                        .wpColorPicker('defaultColorLight2', color);

                    // Update Default Color Dark 2 Color.
                    var color = colors[4];
                    api('default_color_dark_2').set(color);
                    api.control('default_color_dark_2').container.find('.color-picker-hex')
                        .data('data-default-color-dark-2', color)
                        .wpColorPicker('defaultColorDark2', color);

                    // Update Accent Color.
                    var color = colors[5];
                    api('accent_color').set(color);
                    api.control('accent_color').container.find('.color-picker-hex')
                        .data('data-accent-color', color)
                        .wpColorPicker('accentColor', color);

                    // Update Accent Color Light.
                    var color = colors[6];
                    api('accent_color_light').set(color);
                    api.control('accent_color_light').container.find('.color-picker-hex')
                        .data('data-accent-color-light', color)
                        .wpColorPicker('accentColorLight', color);

                    // Update Accent Color Dark.
                    var color = colors[7];
                    api('accent_color_dark').set(color);
                    api.control('accent_color_dark').container.find('.color-picker-hex')
                        .data('data-accent-color-dark', color)
                        .wpColorPicker('accentColorDark', color);

                    // Update Background Color.
                    var color = colors[8];
                    api('background2_color').set(color);
                    api.control('background2_color').container.find('.color-picker-hex')
                        .data('data-background2-color', color)
                        .wpColorPicker('background2Color', color);

                    // Update Menu Header Color.
                    var color = colors[9];
                    api('menu_header_color').set(color);
                    api.control('menu_header_color').container.find('.color-picker-hex')
                        .data('data-menu-header-color', color)
                        .wpColorPicker('menuHeaderColor', color);

                    // Update Entry Header Color.
                    var color = colors[10];
                    api('entry_header_color').set(color);
                    api.control('entry_header_color').container.find('.color-picker-hex')
                        .data('data-entry-header-color', color)
                        .wpColorPicker('entryHeaderColor', color);

                    // Update Main Text Color.
                    var color = colors[11];
                    api('main_text_color').set(color);
                    api.control('main_text_color').container.find('.color-picker-hex')
                        .data('data-main-text-color', color)
                        .wpColorPicker('mainTextColor', color);

                    // Update Secondary Text Color.
                    var color = colors[12];
                    api('secondary_text_color').set(color);
                    api.control('secondary_text_color').container.find('.color-picker-hex')
                        .data('data-secondary-text-color', color)
                        .wpColorPicker('secondaryTextColor', color);

                    // Update Header Text Color.
                    var color = colors[13];
                    api('header_text_color').set(color);
                    api.control('header_text_color').container.find('.color-picker-hex')
                        .data('data-header-text-color', color)
                        .wpColorPicker('headerTextColor', color);

                    // Update Link Color.
                    var color = colors[14];
                    api('link_color').set(color);
                    api.control('link_color').container.find('.color-picker-hex')
                        .data('data-link-color', color)
                        .wpColorPicker('linkColor', color);

                    // Update Light Text Color.
                    var color = colors[15];
                    api('light_text_color').set(color);
                    api.control('light_text_color').container.find('.color-picker-hex')
                        .data('data-light-text-color', color)
                        .wpColorPicker('lightTextColor', color);

                    // Update Danger Color.
                    var color = colors[16];
                    api('danger_color').set(color);
                    api.control('danger_color').container.find('.color-picker-hex')
                        .data('data-danger-color', color)
                        .wpColorPicker('dangerColor', color);

                    // Update Danger Color Light.
                    var color = colors[17];
                    api('danger_color_light').set(color);
                    api.control('danger_color_light').container.find('.color-picker-hex')
                        .data('data-danger-color-light', color)
                        .wpColorPicker('dangerColorLight', color);

                    // Update Danger Color Dark.
                    var color = colors[18];
                    api('danger_color_dark').set(color);
                    api.control('danger_color_dark').container.find('.color-picker-hex')
                        .data('data-danger-color-dark', color)
                        .wpColorPicker('dangerColorDark', color);

                    // Update Footer Color.
                    var color = colors[19];
                    api('footer_color').set(color);
                    api.control('footer_color').container.find('.color-picker-hex')
                        .data('data-footer-color', color)
                        .wpColorPicker('footerColor', color);
                });
            }
        }
    });

    // Generate the CSS for the current Color Scheme.
    function updateCSS() {
        var scheme = api('color_scheme')(),
            css,
            colors = _.object(colorSchemeKeys, colorScheme[scheme].colors);

        // Merge in color scheme overrides.
        _.each(colorSettings, function(setting) {
            colors[setting] = api(setting)();
        });

        // Add additional color.
        // jscs:disable
        colors.border_color = Color(colors.main_text_color).toCSS('rgba', 0.2);
        // jscs:enable

        css = cssTemplate(colors);

        api.previewer.send('update-color-scheme-css', css);
    }

    // Update the CSS whenever a color setting is changed.
    _.each(colorSettings, function(setting) {
        api(setting, function(setting) {
            setting.bind(updateCSS);
        });
    });
})(wp.customize);
