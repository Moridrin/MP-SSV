<?php
/**
 * SSV functions and definitions
 *
 * @package    Moridrin
 * @subpackage SSV
 * @since      SSV 1.0
 */

require_once 'general/general.php';
require_once 'inc/template-tags.php';

function mp_ssv_theme_setup()
{
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-header');
    set_post_thumbnail_size(1920, 480, true);
    add_image_size('ssv-banner-xl', 1920, 480, true);
    add_image_size('ssv-banner-l', 1700, 425, true);
    add_image_size('ssv-banner-m', 1200, 300, true);
    add_image_size('ssv-banner-s', 600, 150, true);
    register_nav_menus(
        array(
            'primary'        => __('Primary Menu', 'ssv'),
            'mobile_primary' => __('Primary Mobile Menu', 'ssv'),
            'mobile_profile' => __('Profile Mobile Menu', 'ssv'),
        )
    );
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        )
    );
    add_theme_support('tabs');
    add_theme_support('materialize');
}

add_action('after_setup_theme', 'mp_ssv_theme_setup');

function mp_ssv_enquire_scripts()
{
    wp_enqueue_script('materialize', get_theme_root_uri() . '/mp-ssv/js/materialize.js', array('jquery'));
    wp_enqueue_script('materialize_init', get_theme_root_uri() . '/mp-ssv/js/init.js', array('jquery'));
    wp_enqueue_style('materialize', get_theme_root_uri() . '/mp-ssv/css/materialize.css');
    wp_enqueue_style('material_icons', 'https://fonts.googleapis.com/icon?family=Material+Icons');
}

add_action('wp_enqueue_scripts', 'mp_ssv_enquire_scripts');

function mp_special_nav_menu_class($classes, $item, $args)
{
    if (in_array('current-menu-item', $classes) || in_array('current_page_item', $classes) || in_array('current-menu-ancestor', $classes) || in_array('current-menu-parent', $classes)) {
        $classes[] = 'active ';
    }
    if (in_array('menu-item-has-children', $classes) && strpos($args->theme_location, 'mobile') === false) {
        $classes[]   = 'dropdown-button';
        $item->title = $item->title . '<i class="material-icons right">arrow_drop_down</i>';
    }
    $classes[] = 'waves-effect';
    return $classes;
}

add_filter('nav_menu_css_class', 'mp_special_nav_menu_class', 10, 3);

function ssv_widgets_init()
{
    register_sidebar(
        array(
            'name'          => __('Sidebar', 'ssv'),
            'id'            => 'sidebar',
            'description'   => __('Add widgets here to appear in your sidebar.', 'ssv'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}

add_action('widgets_init', 'ssv_widgets_init');

function mp_ssv_init_js()
{
}

add_action('wp_loaded', 'mp_ssv_init_js');

function mp_ssv_get_pagination()
{
    global $wp_query;
    $pageCount   = $wp_query->max_num_pages;
    $currentPage = (get_query_var('paged')) ? get_query_var('paged') : 1;
    ob_start();
    ?>
    <ul class="pagination right">
        <?php
        if ($currentPage > 1) {
            ?>
            <li class="waves-effect"><a href="?paged=<?= $currentPage - 1 ?>"><i class="material-icons">chevron_left</i></a></li><?php
        } else {
            ?>
            <li class="disabled waves-effect"><i class="material-icons">chevron_left</i></li><?php
        }
        ?>
        <?php
        for ($i = 1; $i <= $pageCount; $i++) {
            if ($i != $currentPage) {
                ?>
                <li class="waves-effect"><a href="?paged=<?= $i ?>"><?= $i ?></a></li><?php
            } else {
                ?>
                <li class="active waves-effect"><span class="non-link"><?= $i ?></span></li><?php
            }
        }
        if ($currentPage < $pageCount) {
            ?>
            <li class="waves-effect"><a href="?paged=<?= $currentPage + 1 ?>"><i class="material-icons">chevron_right</i></a></li><?php
        } else {
            ?>
            <li class="disabled waves-effect"><i class="material-icons">chevron_right</i></li><?php
        }
        ?>
    </ul>
    <?php
    return ob_get_clean();
}





















//add_filter('the_content', 'ssv_filter_content', 11);

function mp_ssv_menu_sub_menu_link_replace($matches)
{
    global $count;
    $count = isset($count) ?: 0;
    return $matches[0] . 'data-activates="dropdown' . $count++ . '"';
}

function ssv_content_width()
{
    $GLOBALS['content_width'] = apply_filters('ssv_content_width', 1920);
}

//add_action('after_setup_theme', 'ssv_content_width', 0);

if (!function_exists('ssv_fonts_url')) {
    function ssv_fonts_url()
    {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';
        if ('off' !== _x('on', 'Merriweather font: on or off', 'ssv')) {
            $fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
        }
        if ('off' !== _x('on', 'Montserrat font: on or off', 'ssv')) {
            $fonts[] = 'Montserrat:400,700';
        }
        if ('off' !== _x('on', 'Inconsolata font: on or off', 'ssv')) {
            $fonts[] = 'Inconsolata:400';
        }
        if ($fonts) {
            $fonts_url = add_query_arg(
                array(
                    'family' => urlencode(implode('|', $fonts)),
                    'subset' => urlencode($subsets),
                ),
                'https://fonts.googleapis.com/css'
            );
        }
        return $fonts_url;
    }
}

function ssv_scripts()
{
    wp_enqueue_style('ssv-fonts', ssv_fonts_url(), array(), null);
    wp_enqueue_style('genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1');
    wp_enqueue_style('ssv-style', get_stylesheet_uri());
}

//add_action('wp_enqueue_scripts', 'ssv_scripts');

function ssv_body_classes($classes)
{
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

//add_filter('body_class', 'ssv_body_classes');

function ssv_hex2rgb($color)
{
    $color = trim($color, '#');
    if (strlen($color) === 3) {
        $r = hexdec(substr($color, 0, 1) . substr($color, 0, 1));
        $g = hexdec(substr($color, 1, 1) . substr($color, 1, 1));
        $b = hexdec(substr($color, 2, 1) . substr($color, 2, 1));
    } else {
        if (strlen($color) === 6) {
            $r = hexdec(substr($color, 0, 2));
            $g = hexdec(substr($color, 2, 2));
            $b = hexdec(substr($color, 4, 2));
        } else {
            return array();
        }
    }
    return array(
        'red'   => $r,
        'green' => $g,
        'blue'  => $b,
    );
}

function ssv_content_image_sizes_attr($sizes, $size)
{
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

//add_filter('wp_calculate_image_sizes', 'ssv_content_image_sizes_attr', 10, 2);

function ssv_post_thumbnail_sizes_attr($attr, $attachment, $size)
{
    if ('post-thumbnail' === $size) {
        is_active_sidebar('sidebar-1') && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
        !is_active_sidebar('sidebar-1') && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
    }
    return $attr ?: $attachment;
}

//add_filter('wp_get_attachment_image_attributes', 'ssv_post_thumbnail_sizes_attr', 10, 3);

function ssv_my_custom_sizes($sizes)
{
    return array_merge(
        $sizes,
        array(
            'ssv-banner-xl' => __('Banner XL'),
            'ssv-banner-l'  => __('Banner L'),
            'ssv-banner-m'  => __('Banner M'),
            'ssv-banner-s'  => __('Banner S'),
        )
    );
}

//add_filter('image_size_names_choose', 'ssv_my_custom_sizes');

function ssv_override_toolbar_margin()
{
    if (is_admin_bar_showing()) { ?>
        <style type="text/css" media="screen">
            html {
                margin-top: 100px !important;
            }

            * html body {
                margin-top: 100px !important;
            }
        </style>
    <?php } else { ?>
        <style type="text/css" media="screen">
            html {
                margin-top: 70px !important;
            }

            * html body {
                margin-top: 70px !important;
            }
        </style>
    <?php }
}

//add_action('wp_head', 'ssv_override_toolbar_margin', 11);

function ssv_get_search_form($echo = true)
{
    ob_start();
    ?>
    <form role="search" method="get" class="search-form" action="/">
        <div class="textfield textfield--float-label">
            <input type="search" class="search-field" value="" name="s" title="Search for:">
            <label>Search for</label>
        </div>
        <button type="submit" class="btn btn--primary waves-effect waves-light search-submit"><span class="screen-reader-text">Search</span></button>
    </form>
    <?php
    $search_form = ob_get_clean();
    if ($echo) {
        echo $search_form;
    }
    return $search_form;
}