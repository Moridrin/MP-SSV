<?php
/**
 * MP-SSV functions and definitions
 *
 * @package Moridrin
 * @subpackage MP-SSV
 * @since MP-SSV 1.0
 */
require_once 'filter_content.php';
add_filter( 'the_content', 'mp_ssv_filter_content' );

if (!function_exists('mp_ssv_setup')) {
	function mp_ssv_setup()
	{
		load_theme_textdomain('mpssv', get_template_directory() . '/languages');
		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support( 'custom-header') ;
		set_post_thumbnail_size(1920, 480, true);
		add_image_size('mp-ssv-banner-xl', 1920, 480, true);
		add_image_size('mp-ssv-banner-l', 1700, 425, true);
		add_image_size('mp-ssv-banner-m', 1200, 300, true);
		add_image_size('mp-ssv-banner-s', 600, 150, true);
		register_nav_menus(array(
			'primary' => __('Primary Menu', 'mpssv'),
			'social' => __('Social Links Menu', 'mpssv')
		));
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		));
		add_theme_support('post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status',
			'audio',
			'chat'
		));
		add_theme_support('tabs');
		add_theme_support('mui');
	}
}
add_action('after_setup_theme', 'mp_ssv_setup');

function mp_ssv_content_width() {
	$GLOBALS['content_width'] = apply_filters('mp_ssv_content_width', 1920);
}
add_action('after_setup_theme', 'mp_ssv_content_width', 0);

function mp_ssv_widgets_init() {
	register_sidebar(array(
		'name' => __('Sidebar', 'mpssv'),
		'id' => 'sidebar-1',
		'description' => __('Add widgets here to appear in your sidebar.', 'mpssv'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
		'name' => __('Content Bottom', 'mpssv'),
		'id' => 'content-bottom',
		'description' => __('Appears at the bottom of the content on posts and pages.', 'mpssv'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
}
add_action('widgets_init', 'mp_ssv_widgets_init');

if (!function_exists('mp_ssv_fonts_url')) {
	function mp_ssv_fonts_url()
	{
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';
		if ('off' !== _x('on', 'Merriweather font: on or off', 'mpssv')) {
			$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
		}
		if ('off' !== _x('on', 'Montserrat font: on or off', 'mpssv')) {
			$fonts[] = 'Montserrat:400,700';
		}
		if ('off' !== _x('on', 'Inconsolata font: on or off', 'mpssv')) {
			$fonts[] = 'Inconsolata:400';
		}
		if ($fonts) {
			$fonts_url = add_query_arg(array(
				'family' => urlencode(implode('|', $fonts)),
				'subset' => urlencode($subsets)
			), 'https://fonts.googleapis.com/css');
		}
		return $fonts_url;
	}
}

function mp_ssv_scripts() {
	wp_enqueue_style('mpssv-fonts', mp_ssv_fonts_url(), array(), null);
	wp_enqueue_style('genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1');
	wp_enqueue_style('mpssv-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'mp_ssv_scripts');

function mp_ssv_body_classes($classes) {
	if (get_background_image()) {
		$classes[] = 'custom-background-image';
	}
	if (is_multi_author()) {
		$classes[] = 'group-blog';
	}
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}
	return $classes;
}
add_filter('body_class', 'mp_ssv_body_classes');

function mp_ssv_hex2rgb($color) {
	$color = trim($color, '#');
	if (strlen($color) === 3) {
		$r = hexdec(substr($color, 0, 1) . substr($color, 0, 1));
		$g = hexdec(substr($color, 1, 1) . substr($color, 1, 1));
		$b = hexdec(substr($color, 2, 1) . substr($color, 2, 1));
	} else if (strlen($color) === 6) {
		$r = hexdec(substr($color, 0, 2));
		$g = hexdec(substr($color, 2, 2));
		$b = hexdec(substr($color, 4, 2));
	} else {
		return array();
	}
	return array(
		'red' => $r,
		'green' => $g,
		'blue' => $b
	);
}
require get_template_directory() . '/inc/template-tags.php';
#require get_template_directory() . '/inc/customizer.php';

function mp_ssv_content_image_sizes_attr($sizes, $size) {
	$width = $size[0];
	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	if ('page' === get_post_type()) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}
	return $sizes;
}
add_filter('wp_calculate_image_sizes', 'mp_ssv_content_image_sizes_attr', 10, 2);

function mp_ssv_post_thumbnail_sizes_attr($attr, $attachment, $size) {
	if ('post-thumbnail' === $size) {
		is_active_sidebar('sidebar-1') && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		!is_active_sidebar('sidebar-1') && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'mp_ssv_post_thumbnail_sizes_attr', 10, 3);
 
function mp_ssv_my_custom_sizes($sizes) {
    return array_merge($sizes, array(
        'mp-ssv-banner-xl' => __('Banner XL'),
        'mp-ssv-banner-l' => __('Banner L'),
        'mp-ssv-banner-m' => __('Banner M'),
        'mp-ssv-banner-s' => __('Banner S')
    ));
}
add_filter('image_size_names_choose', 'mp_ssv_my_custom_sizes');

function mp_ssv_override_toolbar_margin() {
	if (is_admin_bar_showing()) { ?>
		<style type="text/css" media="screen">
			html { margin-top: 100px !important; }
			* html body { margin-top: 100px !important; }
		</style>
	<?php } else { ?>
		<style type="text/css" media="screen">
			html { margin-top: 70px !important; }
			* html body { margin-top: 70px !important; }
		</style>
	<?php }
}
add_action( 'wp_head', 'mp_ssv_override_toolbar_margin', 11 );

if (!function_exists("mp_ssv_redirect")) {
	function mp_ssv_redirect($location) {
		$redirect_script = '<script type="text/javascript">';
		$redirect_script .= 'window.location = "' . $location . '"';
		$redirect_script .= '</script>';
		echo $redirect_script;
	}
}