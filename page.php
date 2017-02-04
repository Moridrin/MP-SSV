<?php
/**
 * The template for displaying pages
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package    Moridrin
 * @subpackage SSV
 * @since      SSV 1.0
 */
the_post();
get_header(); ?>
<?php if (is_front_page()): ?>
    <header class="full-width-entry-header">
        <div class="parallax-container" style="height: 450px;">
            <div class="parallax"><img src="<?= get_theme_mod('header_image', get_template_directory_uri() . '/images/banner.jpg') ?>"></div>
            <div class="valign-wrapper" style="position: absolute; bottom: 0; width: 100%; height: 100%">
                <div class="valign center-align">
                    <h1 class="entry-title center-align white-text valign" style="margin-top: 0; padding-top: 30px"><?= get_bloginfo() ?></h1>
                    <h3 class="entry-title center-align white-text valign"><?= get_bloginfo('description') ?></h3>
                </div>
            </div>
        </div>
    </header>
<?php else: ?>
    <header class="full-width-entry-header">
        <div class="parallax-container <?= !has_post_thumbnail() ? 'primary' : '' ?>" style="height: 250px;">
            <?php if (has_post_thumbnail()) : ?>
                <div class="parallax"><img src="<?php the_post_thumbnail_url(); ?>"></div>
                <div class="shade darken-1 valign-wrapper" style="position: absolute; bottom: 0; width: 100%; height: 100%">
                    <?php the_title('<h1 class="entry-title center-align white-text valign">', '</h1>'); ?>
                </div>
            <?php else : ?>
                <div class="shade darken-1 valign-wrapper" style="height: 100%">
                    <?php the_title('<h1 class="entry-title center-align white-text valign">', '</h1>'); ?>
                </div>
            <?php endif; ?>
        </div>
    </header>
<?php endif; ?>
<div id="page" class="container <?= is_admin_bar_showing() ? 'wpadminbar' : '' ?>">
    <div class="row">
        <div class="col s12 <?= is_dynamic_sidebar() ? 'm8 l9 xxl10' : '' ?>">
            <div id="primary" class="content-area <?= strpos(get_the_content(), 'class="card') === false ? 'card' : '' ?>">
                <main id="main" class="site-main" role="main">
                    <?php if (is_front_page()): ?>
                        <?php $welcomeMessage = get_theme_mod('welcome_message', ''); ?>
                        <?php if (!empty($welcomeMessage)): ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="card-panel">
                                    <?= $welcomeMessage ?>
                                </div>
                            </article>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php
                    get_template_part('template-parts/content', 'single');
                    if (comments_open() || get_comments_number()) {
                        ?>
                        <div style="padding: 10px;">
                            <?php comments_template(); ?>
                        </div>
                        <?php
                    }
                    ?>
                </main>
            </div>
        </div>
        <?php get_sidebar(); ?>
        <div style="clear: both;"></div>
    </div>
</div>
<?php get_footer(); ?>
