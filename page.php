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
<div id="page" class="container <?php echo is_admin_bar_showing() ? 'wpadminbar' : '' ?>">
    <div class="row">
        <div class="col s12 <?php echo is_dynamic_sidebar() ? 'm7 l8 xxl9' : '' ?>">
            <?php if (is_front_page()): ?>
            <h1 class="entry-title center-align valign" style="margin-top: 0; padding-top: 30px;"><?php echo get_bloginfo() ?></h1>
            <h3 class="entry-title center-align valign"><?php echo get_bloginfo('description') ?></h3>
            <?php endif; ?>
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                    <?php
                    if (is_front_page()) {
                        get_template_part('template-parts/content', 'front-page');
                    }
                    ?>

                </main>
                <?php
                if (is_front_page()) {
                    the_content();
                } else {
                    get_template_part('template-parts/content', 'page');
                    if (comments_open() || get_comments_number()) { ?>
                        <div style="padding: 10px;">
                            <?php comments_template(); ?>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
        <div style="clear: both;"></div>
    </div>
</div>
<?php get_footer(); ?>
