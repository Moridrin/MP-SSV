<?php
/**
 * MP-SSV Customizer functionality
 *
 * @package Moridrin
 * @subpackage MP-SSV
 * @since MP-SSV 1.0
 */

function mp_ssv_custom_header_and_background() {
	$color_scheme             = mp_ssv_get_color_scheme();
	
	$default_background_color = trim( $color_scheme[8], '#' );
	add_theme_support( 'custom-background', apply_filters( 'mp_ssv_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );
	
	$default_background_color = trim( $color_scheme[8], '#' );
	add_theme_support( 'custom-background', apply_filters( 'mp_ssv_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );

	remove_theme_support( 'custom-header' );
}
add_action( 'after_setup_theme', 'mp_ssv_custom_header_and_background' );

if ( ! function_exists( 'mp_ssv_header_style' ) ) :
function mp_ssv_header_style() {
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		return;
	}

	// If the header text has been hidden.
	?>
	<style type="text/css" id="mpssv-header-css">
		.site-branding {
			margin: 0 auto 0 0;
		}

		.site-branding .site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	</style>
	<?php
}
endif; // mp_ssv_header_style

function mp_ssv_customize_register( $wp_customize ) {
	$color_scheme = mp_ssv_get_color_scheme();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'header_textcolor' );

	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'mp_ssv_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Base Color Scheme', 'mpssv' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => mp_ssv_get_color_scheme_choices(),
		'priority' => 1,
	) );

	// Add default color setting and control.
	$wp_customize->add_setting( 'default_color', array(
		'default'           => $color_scheme[0],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'default_color', array(
		'label'       => __( 'Default Color', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add default color light 1 setting and control.
	$wp_customize->add_setting( 'default_color_light_1', array(
		'default'           => $color_scheme[1],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'default_color_light_1', array(
		'label'       => __( 'Default Color Light 1', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add default color dark 1 setting and control.
	$wp_customize->add_setting( 'default_color_dark_1', array(
		'default'           => $color_scheme[2],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'default_color_dark_1', array(
		'label'       => __( 'Default Color Dark 1', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add default color dark 2 setting and control.
	$wp_customize->add_setting( 'default_color_light_2', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'default_color_light_2', array(
		'label'       => __( 'Default Color Light 2', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add default color dark 2 setting and control.
	$wp_customize->add_setting( 'default_color_dark_2', array(
		'default'           => $color_scheme[4],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'default_color_dark_2', array(
		'label'       => __( 'Default Color Dark 2', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add accent color setting and control.
	$wp_customize->add_setting( 'accent_color', array(
		'default'           => $color_scheme[5],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'       => __( 'Accent Color', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add accent color light setting and control.
	$wp_customize->add_setting( 'accent_color_light', array(
		'default'           => $color_scheme[6],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color_light', array(
		'label'       => __( 'Accent Color Light 1', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add accent color dark setting and control.
	$wp_customize->add_setting( 'accent_color_dark', array(
		'default'           => $color_scheme[7],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color_dark', array(
		'label'       => __( 'Accent Color Dark 1', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add background color setting and control.
	$wp_customize->add_setting( 'background2_color', array(
		'default'           => $color_scheme[8],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background2_color', array(
		'label'       => __( 'Background Color', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add menu header color setting and control.
	$wp_customize->add_setting( 'menu_header_color', array(
		'default'           => $color_scheme[9],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_header_color', array(
		'label'       => __( 'Menu Header Color', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add entry header color setting and control.
	$wp_customize->add_setting( 'entry_header_color', array(
		'default'           => $color_scheme[10],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'entry_header_color', array(
		'label'       => __( 'Entry Header Color', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add main text color setting and control.
	$wp_customize->add_setting( 'main_text_color', array(
		'default'           => $color_scheme[11],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_text_color', array(
		'label'       => __( 'Main Text Color', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add secondary text color setting and control.
	$wp_customize->add_setting( 'secondary_text_color', array(
		'default'           => $color_scheme[12],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
		'label'       => __( 'Secondary Text Color', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add header color setting and control.
	$wp_customize->add_setting( 'header_text_color', array(
		'default'           => $color_scheme[13],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_text_color', array(
		'label'       => __( 'Header Text Color', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add link color setting and control.
	$wp_customize->add_setting( 'link_color', array(
		'default'           => $color_scheme[14],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'       => __( 'Link Color', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add light text color setting and control.
	$wp_customize->add_setting( 'light_text_color', array(
		'default'           => $color_scheme[15],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'light_text_color', array(
		'label'       => __( 'Light Text Color', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add danger color setting and control.
	$wp_customize->add_setting( 'danger_color', array(
		'default'           => $color_scheme[16],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'danger_color', array(
		'label'       => __( 'Danger Color', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add danger color light setting and control.
	$wp_customize->add_setting( 'danger_color_light', array(
		'default'           => $color_scheme[17],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'danger_color_light', array(
		'label'       => __( 'Danger Color Light', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add danger color dark setting and control.
	$wp_customize->add_setting( 'danger_color_dark', array(
		'default'           => $color_scheme[18],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'danger_color_dark', array(
		'label'       => __( 'Danger Color Dark', 'mpssv' ),
		'section'     => 'colors',
	) ) );

	// Add footer color setting and control.
	$wp_customize->add_setting( 'footer_color', array(
		'default'           => $color_scheme[19],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_color', array(
		'label'       => __( 'Footer Color', 'mpssv' ),
		'section'     => 'colors',
	) ) );
}
add_action( 'customize_register', 'mp_ssv_customize_register', 11 );


function mp_ssv_get_color_schemes() {
	return apply_filters( 'mp_ssv_color_schemes', array(
		'default' => array(
			'label'  => __( 'All Terrain', 'mpssv' ),
			'colors' => array(
				'#007647',
				'#0b8f5A',
				'#005E38',
				'#29A070',
				'#004127',
				'#AD3400',
				'#D24A10',
				'#8B2900',
				'#FFFFFF',
				'#FFFFFF',
				'#007647',
				'#575757',
				'#999999',
				'#141412',
				'#007647',
				'#FFFFFF',
				'#F44336',
				'#FF685C',
				'#D81D0F',
				'#C7C7C7',
			),
		),
		'custom' => array(
			'label'  => __( 'Custom', 'mpssv' ),
			'colors' => array(
				'#007647',
				'#0b8f5A',
				'#005E38',
				'#29A070',
				'#004127',
				'#AD3400',
				'#D24A10',
				'#8B2900',
				'#FFFFFF',
				'#FFFFFF',
				'#007647',
				'#575757',
				'#999999',
				'#141412',
				'#007647',
				'#FFFFFF',
				'#F44336',
				'#FF685C',
				'#D81D0F',
				'#C7C7C7',
			),
		),
	) );
}

if ( ! function_exists( 'mp_ssv_get_color_scheme' ) ) :
/**
 * Retrieves the current MP-SSV color scheme.
 *
 * Create your own mp_ssv_get_color_scheme() function mp_ssv_to override in a child theme.
 *
 * @since MP-SSV 1.0
 *
 * @return array An associative array of either the current or default color scheme HEX values.
 */
function mp_ssv_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = mp_ssv_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // mp_ssv_get_color_scheme

if ( ! function_exists( 'mp_ssv_get_color_scheme_choices' ) ) :
/**
 * Retrieves an array of color scheme choices registered for MP-SSV.
 *
 * Create your own mp_ssv_get_color_scheme_choices() function mp_ssv_to override
 * in a child theme.
 *
 * @since MP-SSV 1.0
 *
 * @return array Array of color schemes.
 */
function mp_ssv_get_color_scheme_choices() {
	$color_schemes                = mp_ssv_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // mp_ssv_get_color_scheme_choices


if ( ! function_exists( 'mp_ssv_sanitize_color_scheme' ) ) :
/**
 * Handles sanitization for MP-SSV color schemes.
 *
 * Create your own mp_ssv_sanitize_color_scheme() function mp_ssv_to override
 * in a child theme.
 *
 * @since MP-SSV 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function mp_ssv_sanitize_color_scheme( $value ) {
	$color_schemes = mp_ssv_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		return 'default';
	}

	return $value;
}
endif; // mp_ssv_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since MP-SSV 1.0
 *
 * @see wp_add_inline_style()
 */
function mp_ssv_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}

	$color_scheme = mp_ssv_get_color_scheme();

	// If we get this far, we have a custom color scheme.
	$colors = array(

		'default_color'         => $color_scheme[0],
		'default_color_light_1'	=> $color_scheme[1],
		'default_color_dark_1'	=> $color_scheme[2],
		'default_color_light_2'	=> $color_scheme[3],
		'default_color_dark_2'	=> $color_scheme[4],
		'accent_color'			=> $color_scheme[5],
		'accent_color_light'	=> $color_scheme[6],
		'accent_color_dark'		=> $color_scheme[7],
		'background_color'      => $color_scheme[8],
		'menu_header_color'		=> $color_scheme[9],
		'entry_header_color'	=> $color_scheme[10],
		'main_text_color'       => $color_scheme[11],
		'secondary_text_color'  => $color_scheme[12],
		'header_text_color'     => $color_scheme[13],
		'link_color'            => $color_scheme[14],
		'light_text_color'		=> $color_scheme[15],
		'danger_color'			=> $color_scheme[16],
		'danger_color_light'	=> $color_scheme[17],
		'danger_color_dark'		=> $color_scheme[18],
		'footer_color'			=> $color_scheme[19],
	);

	$color_scheme_css = mp_ssv_get_color_scheme_css( $colors );

	wp_add_inline_style( 'mpssv-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_color_scheme_css' );

/**
 * Binds the JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since MP-SSV 1.0
 */
function mp_ssv_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20150825', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', mp_ssv_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'mp_ssv_customize_control_js' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since MP-SSV 1.0
 */
function mp_ssv_customize_preview_js() {
	wp_enqueue_script( 'mpssv-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20150825', true );
}
add_action( 'customize_preview_init', 'mp_ssv_customize_preview_js' );

/**
 * Returns CSS for the color schemes.
 *
 * @since MP-SSV 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function mp_ssv_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'default_color'			=> '',
		'default_color_light_1'	=> '',
		'default_color_dark_1'	=> '',
		'default_color_light_2'	=> '',
		'default_color_dark_2'	=> '',
		'accent_color'			=> '',
		'accent_color_light'	=> '',
		'accent_color_dark'		=> '',
		'background_color'		=> '',
		'menu_header_color'		=> '',
		'entry_header_color'	=> '',
		'main_text_color'		=> '',
		'secondary_text_color'	=> '',
		'header_text_color'		=> '',
		'link_color'			=> '',
		'light_text_color'		=> '',
		'danger_color'			=> '',
		'danger_color_light'	=> '',
		'danger_color_dark'		=> '',
		'footer_color'			=> '',
	) );

	return <<<CSS
	/*Default Color*/
	.current-menu-item > a,
	.current-menu-ancestor > a,
	.main-navigation li:hover > a,
	.main-navigation li:focus > a {
		background-color: {$colors['default_color']} !important;/*#007647*/
	}

	.main-navigation ul li ul li:hover > a,
	.main-navigation ul li ul li:focus > a {
		background-color: {$colors['default_color']};/*#007647*/
	}

	.mui-btn--primary {
		background-color: {$colors['default_color']} !important;/*#007647*/
	}

	blockquote,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.post-navigation,
	.post-navigation div + div,
	.pagination,
	.widget,
	.page-header,
	.page-links a,
	.comments-title,
	.comment-reply-title {
		border-color: {$colors['default_color']};/*#007647*/
	}

	.notification {
		background-color: {$colors['default_color']};/*#007647*/
	}

	/*Default Color Light 1*/
	.mui-btn--primary:active,
	.mui-btn--primary:focus,
	.mui-btn--primary:hover {
		background-color: {$colors['default_color_light_1']} !important;/*#0b8f5A*/
	}

	/*Default Color Dark 1*/

	/*Default Color Light 2*/
	input:focus,
	textarea:focus,
	input[type="text"]:focus,
	input[type="email"]:focus,
	input[type="url"]:focus,
	input[type="password"]:focus,
	input[type="search"]:focus,
	textarea:focus,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.menu-toggle:hover,
	.menu-toggle:focus {
		border: 1px solid {$colors['default_color_light_2']};/*#29A070*/
	}

	/*Default Color Dark 2*/

	/*Accent Color*/
	.mui-btn--accent {
		background-color: {$colors['accent_color']} !important;/*#ad3400*/
	}

	/*Accent Color Light 1*/
	.mui-btn--accent:active,
	.mui-btn--accent:focus,
	.mui-btn--accent:hover {
		background-color: {$colors['accent_color_light']} !important;/*#d24a10*/
	}

	/*Accent Color Dark 1*/

	/*Background Color*/
	body {
		background-color: {$colors['background_color']};/*#ffffff*/
	}

	/*Menu Header Color*/
	.site-header {
		background-color: {$colors['menu_header_color']};/*#ffffff*/
	}

	.main-navigation ul li ul li a {
		background-color: {$colors['menu_header_color']};/*#ffffff*/
	}

	/*Entry Header Color*/
	.entry-header {
		background-color: {$colors['entry_header_color']};/*#007647*/
	}

	/*Main Text Color*/
	body,
	blockquote cite,
	blockquote small,
	.menu-toggle,
	.dropdown-toggle,
	.social-navigation a,
	.post-navigation a,
	.pagination a:hover,
	.pagination a:focus,
	.widget-title a,
	.site-branding .site-title a,
	.page-links > .page-links-title,
	.comment-author,
	.comment-reply-title small a:hover,
	.comment-reply-title small a:focus {
		color: {$colors['main_text_color']};/*#575757*/
	}

	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.pagination:before,
	.pagination:after,
	.pagination .prev,
	.pagination .next,
	.page-links a {
		background-color: {$colors['main_text_color']};/*#575757*/
	}

	/*Secondary Text Color*/
	body:not(.search-results) .entry-summary {
		color: {$colors['secondary_text_color']};/*#999999*/
	}

	blockquote,
	.post-password-form label,
	a:hover,
	a:focus,
	a:active,
	.post-navigation .meta-nav,
	.image-navigation,
	.comment-navigation,
	.widget_recent_entries .post-date,
	.widget_rss .rss-date,
	.widget_rss cite,
	.site-description,
	.author-bio,
	.entry-footer,
	.entry-footer a,
	.sticky-post,
	.taxonomy-description,
	.entry-caption,
	.comment-metadata,
	.pingback .edit-link,
	.comment-metadata a,
	.pingback .comment-edit-link,
	.comment-form label,
	.comment-notes,
	.comment-awaiting-moderation,
	.note,
	.logged-in-as,
	.form-allowed-tags,
	.wp-caption .wp-caption-text,
	.gallery-caption,
	.widecolumn label,
	.widecolumn .mu_register label {
		color: {$colors['secondary_text_color']};/*#999999*/
	}

	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus {
		background-color: {$colors['secondary_text_color']};/*#999999*/
	}

	/*Header Text Color*/
	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	.entry-title a {
		color: {$colors['header_text_color']};/*#141412*/
	}

	/*Link Color*/
	.menu-toggle:hover,
	.menu-toggle:focus,
	a,
	.dropdown-toggle:hover,
	.dropdown-toggle:focus,
	.social-navigation a:hover:before,
	.social-navigation a:focus:before,
	.post-navigation a:hover .post-title,
	.post-navigation a:focus .post-title,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.site-branding .site-title a:hover,
	.site-branding .site-title a:focus,
	.entry-title a:hover,
	.entry-title a:focus,
	.entry-footer a:hover,
	.entry-footer a:focus,
	.comment-metadata a:hover,
	.comment-metadata a:focus,
	.pingback .comment-edit-link:hover,
	.pingback .comment-edit-link:focus,
	.comment-reply-link,
	.comment-reply-link:hover,
	.comment-reply-link:focus,
	.required,
	.site-info a:hover,
	.site-info a:focus {
		color: {$colors['link_color']};/*#007647*/
	}

	mark,
	ins,
	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.widget_calendar tbody a,
	.page-links a:hover,
	.page-links a:focus {
		background-color: {$colors['link_color']};/*#007647*/
	}

	input[type="text"]:focus,
	input[type="email"]:focus,
	input[type="url"]:focus,
	input[type="password"]:focus,
	input[type="search"]:focus,
	textarea:focus,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.menu-toggle:hover,
	.menu-toggle:focus {
		border-color: {$colors['link_color']};/*#007647*/
	}

	/*Light Text Color*/
	.current-menu-item > a,
	.current-menu-ancestor > a,
	.main-navigation li:hover > a,
	.main-navigation li:focus > a {
		color: {$colors['light_text_color']} !important;/*#ffffff*/
	}

	.main-navigation ul li ul li:hover > a,
	.main-navigation ul li ul li:focus > a {
		color: {$colors['light_text_color']} !important;/*#ffffff*/
		color: #ffffff !important;
	}

	.entry-header h1,
	.entry-header h2,
	.entry-header h1 > a,
	.entry-header h2 > a {
		color: {$colors['light_text_color']} !important;/*#ffffff*/
	}

	.site-info
	.site-info a {
		color: {$colors['light_text_color']} !important;/*#ffffff*/
	}

	/* Danger Color */
	.mui-btn--danger {
		background-color: {$colors['danger_color']} !important;/*#f44336*/
	}

	/* Danger Color Light 1 */
	.mui-btn--danger:active,
	.mui-btn--danger:focus,
	.mui-btn--danger:hover {
		background-color: {$colors['danger_color_light']} !important;/*#999999*/
	}

	/* Danger Color Dark 1 */

	/*Footer Color*/
	.site-footer {
		background-color: {$colors['footer_color']};/*#c7c7c7*/
		box-shadow: 0px 500px 0px 500px {$colors['footer_color']};
	}


CSS;
}


/**
 * Outputs an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the
 * Customizer preview.
 *
 * @since MP-SSV 1.0
 */
function mp_ssv_color_scheme_css_template() {
	$colors = array(
		'default_color'			=> '{{ data.default_color }}',
		'default_color_light_1'	=> '{{ data.default_color_light_1 }}',
		'default_color_dark_1'	=> '{{ data.default_color_dark_1 }}',
		'default_color_light_2'	=> '{{ data.default_color_light_2 }}',
		'default_color_dark_2'	=> '{{ data.default_color_dark_2 }}',
		'accent_color'			=> '{{ data.accent_color }}',
		'accent_color_light'	=> '{{ data.accent_color_light }}',
		'accent_color_dark'		=> '{{ data.accent_color_dark }}',
		'background_color'		=> '{{ data.background_color }}',
		'menu_header_color'		=> '{{ data.menu_header_color }}',
		'entry_header_color'	=> '{{ data.entry_header_color }}',
		'main_text_color'		=> '{{ data.main_text_color }}',
		'secondary_text_color'	=> '{{ data.secondary_text_color }}',
		'header_text_color'		=> '{{ data.header_text_color }}',
		'link_color'			=> '{{ data.link_color }}',
		'light_text_color'		=> '{{ data.light_text_color }}',
		'danger_color'			=> '{{ data.danger_color }}',
		'danger_color_light'	=> '{{ data.danger_color_light }}',
		'danger_color_dark'		=> '{{ data.danger_color_dark }}',
		'footer_color'			=> '{{ data.footer_color }}',
	);
	?>
	<script type="text/html" id="tmpl-mpssv-color-scheme">
		<?php echo mp_ssv_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'mp_ssv_color_scheme_css_template' );

function mp_ssv_default_color_css() {
	$color_scheme          = mp_ssv_get_color_scheme();
	$def_color             = $color_scheme[0];
	$default_color = get_theme_mod( 'default_color', $def_color );


	$css = '
		/*Default Color*/
		.current-menu-item > a,
		.current-menu-ancestor > a,
		.main-navigation li:hover > a,
		.main-navigation li:focus > a {
			background-color: %1$s !important;/*#007647*/
		}

		.main-navigation ul li ul li:hover > a,
		.main-navigation ul li ul li:focus > a {
			background-color: %1$s;/*#007647*/
		}

		.mui-btn--primary {
			background-color: %1$s !important;/*#007647*/
		}

		blockquote,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.post-navigation,
		.post-navigation div + div,
		.pagination,
		.widget,
		.page-header,
		.page-links a,
		.comments-title,
		.comment-reply-title {
			border-color: %1$s;/*#007647*/
		}

		.notification {
			background-color: %1$s;/*#007647*/
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $default_color ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_default_color_css', 11 );

function mp_ssv_default_color_light_1_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[1];
	$default_color_light_1 = get_theme_mod( 'default_color_light_1', $default_color );


	$css = '
	/*Default Color Light 1*/
		.mui-btn--primary:active,
		.mui-btn--primary:focus,
		.mui-btn--primary:hover {
				background-color: %1$s !important;/*#0b8f5A*/
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $default_color_light_1 ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_default_color_light_1_css', 11 );

function mp_ssv_default_color_dark_1_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[2];
	$default_color_dark_1 = get_theme_mod( 'default_color_dark_1', $default_color );


	$css = '
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $default_color_dark_1 ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_default_color_dark_1_css', 11 );

function mp_ssv_default_color_light_2_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[3];
	$default_color_light_2 = get_theme_mod( 'default_color_light_2', $default_color );


	$css = '
		input:focus,
		textarea:focus,
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		textarea:focus,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.menu-toggle:hover,
		.menu-toggle:focus {
			border: 1px solid %1$s;/*#29A070*/
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $default_color_light_2 ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_default_color_light_2_css', 11 );

function mp_ssv_default_color_dark_2_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[4];
	$default_color_dark_2 = get_theme_mod( 'default_color_dark_2', $default_color );


	$css = '
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $default_color_dark_2 ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_default_color_dark_2_css', 11 );

function mp_ssv_accent_color_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[5];
	$accent_color = get_theme_mod( 'accent_color', $default_color );


	$css = '
		.mui-btn--accent {
			background-color: %1$s !important;/*#ad3400*/
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $accent_color ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_accent_color_css', 11 );

function mp_ssv_accent_color_light_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[6];
	$accent_color_light = get_theme_mod( 'accent_color_light', $default_color );


	$css = '
		.mui-btn--accent:active,
		.mui-btn--accent:focus,
		.mui-btn--accent:hover {
			background-color: %1$s !important;/*#d24a10*/
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $accent_color_light ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_accent_color_light_css', 11 );

function mp_ssv_accent_color_dark_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[7];
	$accent_color_dark = get_theme_mod( 'accent_color_dark', $default_color );


	$css = '
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $accent_color_dark ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_accent_color_dark_css', 11 );

function mp_ssv_background_color_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[8];
	$background_color = get_theme_mod( 'background_color', $default_color );


	$css = '
		body {
			background-color: %1$s;/*#ffffff*/
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $background_color ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_background_color_css', 11 );

function mp_ssv_menu_header_color_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[9];
	$menu_header_color = get_theme_mod( 'menu_header_color', $default_color );


	$css = '
		.site-header {
			background-color: %1$s;/*#ffffff*/
		}

		.main-navigation ul li ul li a {
			background-color: %1$s;/*#ffffff*/
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $menu_header_color ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_menu_header_color_css', 11 );

function mp_ssv_entry_header_color_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[10];
	$entry_header_color = get_theme_mod( 'entry_header_color', $default_color );


	$css = '
		.entry-header {
			background-color: %1$s;/*#007647*/
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $entry_header_color ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_entry_header_color_css', 11 );

function mp_ssv_main_text_color_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[11];
	$main_text_color = get_theme_mod( 'main_text_color', $default_color );


	$css = '
		body,
		blockquote cite,
		blockquote small,
		.menu-toggle,
		.dropdown-toggle,
		.social-navigation a,
		.post-navigation a,
		.pagination a:hover,
		.pagination a:focus,
		.widget-title a,
		.site-branding .site-title a,
		.page-links > .page-links-title,
		.comment-author,
		.comment-reply-title small a:hover,
		.comment-reply-title small a:focus {
			color: %1$s;/*#575757*/
		}

		button,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.pagination:before,
		.pagination:after,
		.pagination .prev,
		.pagination .next,
		.page-links a {
			background-color: %1$s;/*#575757*/
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $main_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_main_text_color_css', 11 );

function mp_ssv_secondary_text_color_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[12];
	$secondary_text_color = get_theme_mod( 'secondary_text_color', $default_color );


	$css = '
		body:not(.search-results) .entry-summary {
			color: %1$s;/*#999999*/
		}

		blockquote,
		.post-password-form label,
		a:hover,
		a:focus,
		a:active,
		.post-navigation .meta-nav,
		.image-navigation,
		.comment-navigation,
		.widget_recent_entries .post-date,
		.widget_rss .rss-date,
		.widget_rss cite,
		.site-description,
		.author-bio,
		.entry-footer,
		.entry-footer a,
		.sticky-post,
		.taxonomy-description,
		.entry-caption,
		.comment-metadata,
		.pingback .edit-link,
		.comment-metadata a,
		.pingback .comment-edit-link,
		.comment-form label,
		.comment-notes,
		.comment-awaiting-moderation,
		.note,
		.logged-in-as,
		.form-allowed-tags,
		.wp-caption .wp-caption-text,
		.gallery-caption,
		.widecolumn label,
		.widecolumn .mu_register label {
			color: %1$s;/*#999999*/
		}

		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			background-color: %1$s;/*#999999*/
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $secondary_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_secondary_text_color_css', 11 );

function mp_ssv_header_text_color_css() {
		$color_scheme    = mp_ssv_get_color_scheme();
		$default_color   = $color_scheme[13];
		$header_text_color = get_theme_mod( 'header_text_color', $default_color );


		$css = '
		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		.entry-title a {
			color: %1$s;/*#141412*/
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $header_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_header_text_color_css', 11 );

function mp_ssv_link_color_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[14];
	$link_color = get_theme_mod( 'link_color', $default_color );


	$css = '
		.menu-toggle:hover,
		.menu-toggle:focus,
		a,
		.dropdown-toggle:hover,
		.dropdown-toggle:focus,
		.social-navigation a:hover:before,
		.social-navigation a:focus:before,
		.post-navigation a:hover .post-title,
		.post-navigation a:focus .post-title,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.site-branding .site-title a:hover,
		.site-branding .site-title a:focus,
		.entry-title a:hover,
		.entry-title a:focus,
		.entry-footer a:hover,
		.entry-footer a:focus,
		.comment-metadata a:hover,
		.comment-metadata a:focus,
		.pingback .comment-edit-link:hover,
		.pingback .comment-edit-link:focus,
		.comment-reply-link,
		.comment-reply-link:hover,
		.comment-reply-link:focus,
		.required,
		.site-info a:hover,
		.site-info a:focus {
			color: %1$s;/*#007647*/
		}

		mark,
		ins,
		button:hover,
		button:focus,
		input[type="button"]:hover,
		input[type="button"]:focus,
		input[type="reset"]:hover,
		input[type="reset"]:focus,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus,
		.widget_calendar tbody a,
		.page-links a:hover,
		.page-links a:focus {
			background-color: %1$s;/*#007647*/
		}

		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		textarea:focus,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.menu-toggle:hover,
		.menu-toggle:focus {
			border-color: %1$s;/*#007647*/
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_link_color_css', 11 );

function mp_ssv_light_text_color_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[15];
	$light_text_color = get_theme_mod( 'light_text_color', $default_color );


	$css = '
		.current-menu-item > a,
		.current-menu-ancestor > a,
		.main-navigation li:hover > a,
		.main-navigation li:focus > a {
			color: %1$s !important;/*#ffffff*/
		}

		.main-navigation ul li ul li:hover > a,
		.main-navigation ul li ul li:focus > a {
			color: %1$s !important;/*#ffffff*/
		}

		.entry-header h1,
		.entry-header h2,
		.entry-header h1 > a,
		.entry-header h2 > a {
			color: %1$s !important;/*#ffffff*/
		}

		.site-info,
		.site-info a {
			color: %1$s !important;/*#ffffff*/
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $light_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_light_text_color_css', 11 );

function mp_ssv_danger_color_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[16];
	$danger_color = get_theme_mod( 'danger_color', $default_color );


	$css = '
		.mui-btn--danger {
			background-color: %1$s !important;/*#f44336*/
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $danger_color ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_danger_color_css', 11 );

function mp_ssv_danger_color_light_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[17];
	$danger_color_light = get_theme_mod( 'danger_color_light', $default_color );


	$css = '
		.mui-btn--danger:active,
		.mui-btn--danger:focus,
		.mui-btn--danger:hover {
			background-color: %1$s !important;/*#999999*/
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $danger_color_light ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_danger_color_light_css', 11 );

function mp_ssv_danger_color_dark_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[18];
	$danger_color_dark = get_theme_mod( 'danger_color_dark', $default_color );


	$css = '
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $danger_color_dark ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_danger_color_dark_css', 11 );

function mp_ssv_footer_color_css() {
	$color_scheme    = mp_ssv_get_color_scheme();
	$default_color   = $color_scheme[19];
	$footer_color = get_theme_mod( 'footer_color', $default_color );


	$css = '
		.site-footer {
			background-color: %1$s;/*#c7c7c7*/
			box-shadow: 0px 500px 0px 500px %1$s;
		}
	';

	wp_add_inline_style( 'mpssv-style', sprintf( $css, $footer_color ) );
}
add_action( 'wp_enqueue_scripts', 'mp_ssv_footer_color_css', 11 );
