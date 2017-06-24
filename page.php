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
            <div id="primary" class="content-area <?php echo strpos(get_the_content(), 'class="card') === false ? 'card' : '' ?>">
                <main id="main" class="site-main" role="main">
                    <?php if (is_front_page()): ?>
                        <?php $welcomeMessage = get_theme_mod('welcome_message', ''); ?>
                        <?php if (!empty($welcomeMessage)): ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="card-panel">
                                    <?php echo $welcomeMessage ?>
                                </div>
                            </article>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php
                    get_template_part('template-parts/content', 'page');
                    if (comments_open() || get_comments_number()): ?>
                        <div style="padding: 10px;">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>
                </main>
            </div>
        </div>
        <?php get_sidebar(); ?>
        <div style="clear: both;"></div>
    </div>
</div>
<?php get_footer(); ?>
