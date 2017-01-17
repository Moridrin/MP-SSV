<?php
/**
 * SSV functions and definitions
 *
 * @package    Moridrin
 * @subpackage SSV
 * @since      SSV 1.0
 */

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
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

function mp_ssv_custom_image_sizes($sizes)
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

add_filter('image_size_names_choose', 'mp_ssv_custom_image_sizes');

function mp_ssv_enquire_scripts()
{
    wp_enqueue_script('materialize', get_theme_root_uri() . '/mp-ssv/js/materialize.js', array('jquery'));
    if (is_customize_preview()) {
        //Uses Generated CSS
    } else {
        wp_enqueue_style('materialize', get_theme_root_uri() . '/mp-ssv/css/materialize.css');
    }
    wp_enqueue_style('material_icons', 'https://fonts.googleapis.com/icon?family=Material+Icons');
    if (is_404()) {
        wp_enqueue_script('bb8', get_theme_root_uri() . '/mp-ssv/js/BB8.js', array('jquery'));
        wp_enqueue_style('bb8', get_theme_root_uri() . '/mp-ssv/css/BB8.css');
    } else {
        wp_enqueue_script('materialize_init', get_theme_root_uri() . '/mp-ssv/js/init.js', array('jquery'));
    }
}

add_action('wp_enqueue_scripts', 'mp_ssv_enquire_scripts');

function mp_ssv_enquire_admin_scripts()
{
    wp_enqueue_script('datetimepicker', get_theme_root_uri() . '/mp-ssv/js/jquery.datetimepicker.full.js', 'jquery-ui-datepicker');
    wp_enqueue_script('datetimepicker_admin_init', get_theme_root_uri() . '/mp-ssv/js/admin-init.js', 'datetimepicker');
    wp_enqueue_style('datetimepicker_admin_css', get_theme_root_uri() . '/mp-ssv/css/jquery.datetimepicker.css');
}

add_action('admin_enqueue_scripts', 'mp_ssv_enquire_admin_scripts', 12);

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

function mp_ssv_widgets_init()
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

add_action('widgets_init', 'mp_ssv_widgets_init');

function mp_ssv_init_js()
{
}

add_action('wp_loaded', 'mp_ssv_init_js');

/**
 * @return string
 * @internal param null|WP_Query $query
 */
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

function mp_ssv_customize_register($wp_customize)
{
    /** @var WP_Customize_Manager $wp_customize */
    $wp_customize->add_section(
        'mp_ssv',
        array(
            'title' => 'SSV',
        )
    );
    mp_ssv_add_color_customizer($wp_customize, 'primary_color', 'Primary Color', '#005E38');
    mp_ssv_add_color_customizer($wp_customize, 'text_on_primary_color', 'Text On Primary Color', '#FFFFFF');
    mp_ssv_add_color_customizer($wp_customize, 'secondary_color', 'Secondary Color', '#26A69A');
    mp_ssv_add_color_customizer($wp_customize, 'text_on_secondary_color', 'Text On Secondary Color', '#FFFFFF');
    mp_ssv_add_color_customizer($wp_customize, 'link_color', 'Link Color', '#039BE5');
    mp_ssv_add_color_customizer($wp_customize, 'success_color', 'Success Color', '#4CAF50');
    mp_ssv_add_color_customizer($wp_customize, 'error_color', 'Error Color', '#F44336');
}

function mp_ssv_add_color_customizer($wp_customize, $name, $label, $default)
{
    /** @var WP_Customize_Manager $wp_customize */
    $wp_customize->add_setting(
        $name,
        array(
            'default' => $default,
        )
    );
    $wp_customize->add_control(
        $name,
        array(
            'label'   => $label,
            'section' => 'colors',
            'type'    => 'color',
        )
    );
}

add_action('customize_register', 'mp_ssv_customize_register');

function mp_ssv_customize_css()
{
    if (is_customize_preview()) {
        require_once "compiling-source/scssphp/scss.inc.php";
        $scss = new \Leafo\ScssPhp\Compiler();
        $scss->setVariables(
            array(
                'primary-color'           => get_theme_mod('primary_color', '#005E38'),
                'text-on-primary-color'   => get_theme_mod('text_on_primary_color', '#FFFFFF'),
                'secondary-color'         => get_theme_mod('secondary_color', '#26A69A'),
                'text-on-secondary-color' => get_theme_mod('text_on_secondary_color', '#FFFFFF'),
                'link-color'              => get_theme_mod('link_color', '#039BE5'),
                'success-color'           => get_theme_mod('success_color', '#4CAF50'),
                'error-color'             => get_theme_mod('error_color', '#F44336'),
            )
        );
        $compiled = $scss->compile('@import "' . get_theme_file_path() . '/compiling-source/sass/materialize"');

        $materializeCSSFile = fopen(get_theme_file_path() . '/css/materialize.css', "w") or SSV_General::var_export('test', 1);
        fwrite($materializeCSSFile, $compiled);
        fclose($materializeCSSFile);
        echo '<style id="moridrin">';
        echo $compiled;
        echo '</style>';
    }
}

add_action('wp_head', 'mp_ssv_customize_css');

