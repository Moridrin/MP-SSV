<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package    Moridrin
 * @subpackage SSV
 * @since      SSV 1.0
 */

get_header(); ?>
<header class="full-width-entry-header">
    <div class="parallax-container" style="height: 150px;">
        <?php if (has_post_thumbnail()) : ?>
            <div class="parallax"><img src="<?php the_post_thumbnail_url(); ?>"></div>
            <div class="shade darken-1 valign-wrapper" style="position: absolute; bottom: 0; width: 100%; height: 100%">
                <?php the_title('<h1 class="entry-title center-align white-text valign">', '</h1>'); ?>
            </div>
        <?php else : ?>
            <div class="parallax shade darken-1 valign-wrapper">
                <?php the_title('<h1 class="entry-title center-align white-text valign">', '</h1>'); ?>
            </div>
        <?php endif; ?>
    </div>
</header>
<div id="page" class="container <?= is_admin_bar_showing() ? 'wpadminbar' : '' ?>">
    <div class="row">
        <div class="col s12 <?= is_dynamic_sidebar() ? 'm8 l9 xxl10' : '' ?>">
            <div id="primary" class="content-area <?= strpos(get_the_content(), 'class="card') === false ? 'card' : '' ?>">
                <main id="main" class="site-main" role="main">
                    <?php
                    the_post();
                    get_template_part('template-parts/content', 'single');
                    ?>
                    <div style="padding: 10px;"><?php
                        if (comments_open() || get_comments_number()) {
                            comments_template();
                        }
                        ?>
                    </div>
                </main>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
