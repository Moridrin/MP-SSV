<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <?php wp_head(); ?>
        <meta charset="<?php bloginfo('charset'); ?>" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="theme-color" content="<?php echo get_theme_mod('primary_color', '#005E38') ?>">
        <?php if (is_singular() && pings_open(get_queried_object())) : ?>
            <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php endif; ?>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="manifest" href="<?php echo get_template_directory_uri() . '/manifest.json' ?>">
    </head>
    <header>
        <?php echo mp_ssv_get_main_nav_bar() ?>
        <?php echo mp_ssv_get_side_menu() ?>
    </header>
    <body <?php body_class(); ?>>
<?php

function mp_ssv_get_main_nav_bar()
{
    ob_start();
    if (!is_home() && !is_front_page()) {
        ?><a class="nav-logo" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
        <?php
        $logoPath = get_theme_mod('navbar_logo', false);
        if (!$logoPath) {
            $logoPath = get_template_directory_uri() . '/images/logo.svg';
        }
        ?>
        <img src="<?= $logoPath ?>" alt="<?php bloginfo('name'); ?>" style="height:55px"/></a>
        <?php
    }
    $branding           = ob_get_clean();
    $mobile_menu_toggle = '<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>';
    $menu               = wp_nav_menu(
        array(
            'theme_location' => 'primary',
            'menu_class'     => 'right hide-on-small-and-down',
            'items_wrap'     => '<ul style="line-height: 64px;" id="%1$s" class="%2$s">%3$s</ul>',
            'echo'           => false,
        )
    );
    $menu               = preg_replace('/\s+/', ' ', str_replace(PHP_EOL, '', $menu));
    $menu               = preg_replace('/<div.*?>(.*)<\/div>/s', '$1', $menu);
    $menu               = preg_replace_callback('/class="[^"]+menu-item-has-children.*?"/s', 'mp_ssv_menu_sub_menu_link_replace', $menu);
    preg_match_all('/<ul class="sub-menu">(.*?)<\/ul>/s', $menu, $subMenus);
    $i = 0;
    foreach ($subMenus[0] as $subMenu) {
        $menu = str_replace($subMenu, '', $menu);
        $i++;
    }
    $i = 0;
    ob_start();
    foreach ($subMenus[1] as $subMenuContent) {
        ?><ul id="dropdown<?php echo $i ?>" class="dropdown-content"><?php echo $subMenuContent ?></ul><?php
        $i++;
    }
    $subMenus = ob_get_clean();
    return $subMenus . '<nav><div class="nav-wrapper">' . $mobile_menu_toggle . $branding . $menu . '</div></nav>';
}

function mp_ssv_menu_sub_menu_link_replace($matches)
{
    global $count;
    $count = isset($count) ?: 0;
    return $matches[0] . 'data-activates="dropdown' . $count++ . '"';
}

function mp_ssv_get_side_menu()
{
$mobile_primary_menu       = wp_nav_menu(
    array(
        'theme_location' => 'mobile_primary',
        'menu_class'     => 'left hide-on-med-and-down',
        'items_wrap'     => '<ul style="line-height: 64px;" id="%1$s" class="%2$s">%3$s</ul>',
        'echo'           => false,
    )
);
$mobile_primary_menu       = preg_replace('/\s+/', ' ', str_replace(PHP_EOL, '', $mobile_primary_menu));
$mobile_primary_menu       = preg_replace('/<div.*?>(.*)<\/div>/s', '$1', $mobile_primary_menu);
$mobile_primary_menu_items = preg_replace('/<ul.*?>(.*)<\/ul>/s', '$1', $mobile_primary_menu);

$mobile_profile_menu       = wp_nav_menu(
    array(
        'theme_location' => 'mobile_profile',
        'menu_class'     => 'left hide-on-med-and-down',
        'items_wrap'     => '<ul style="line-height: 64px;" id="%1$s" class="%2$s">%3$s</ul>',
        'echo'           => false,
    )
);
$mobile_profile_menu       = preg_replace('/\s+/', ' ', str_replace(PHP_EOL, '', $mobile_profile_menu));
$mobile_profile_menu       = preg_replace('/<div.*?>(.*)<\/div>/s', '$1', $mobile_profile_menu);
$mobile_profile_menu_items = preg_replace('/<ul.*?>(.*)<\/ul>/s', '$1', $mobile_profile_menu);

ob_start();
?>
<ul id="slide-out" class="side-nav" style="<?php echo is_admin_bar_showing() ? 'top: 46px;' : '' ?>">
    <?php
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        ?>
        <li>
            <div class="userView">
                <div class="background">
                    <img src="<?php echo get_template_directory_uri() . '/' ?>images/menu_profile_background.jpg" alt="Profile Background Image">
                </div>
                <a href="<?php echo $user->user_url ?>">
                    <?php echo get_avatar($user->ID, 96, '', '', array('class' => 'circle')) ?>
                    <span class="white-text name"><?php echo $user->display_name ?></span>
                    <span class="white-text email"><?php echo $user->user_email ?></span>
                </a>
            </div>
        </li>
        <?php
    }
    echo $mobile_primary_menu_items;
    ?>
    <li>
        <div class=" divider"></div>
    </li>
    <?php echo $mobile_profile_menu_items ?>
</ul>
<?php
    return ob_get_clean();
}