<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package    Moridrin
 * @subpackage SSV
 * @since      SSV 1.0
 */

get_header(); ?>
<header class="full-width-entry-header visible-xs-block">
    <div class="parallax-container" style="height: 150px;">
        <div class="parallax"><img src="<?php the_post_thumbnail_url(); ?>"></div>
        <div class="shade darken-5 valign-wrapper" style="position: absolute; bottom: 0; width: 100%; height: 100%">
            <?php the_title('<h1 class="entry-title center-align white-text valign">', '</h1>'); ?>
        </div>
    </div>
</header><!-- .entry-header -->
<div id="page" class="container container">
    <div class="card col s12 <?= is_dynamic_sidebar() ? 'col m8 l9' : '' ?>">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php
                // Start the loop.
                while (have_posts()) : the_post();

                    // Include the single post content template.
                    get_template_part('template-parts/content', 'single');

                    ?><div style="padding: 10px;"><?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                    ?></div><?php

                    // End of the loop.
                endwhile;
                ?>

            </main><!-- .site-main -->
        </div><!-- .content-area -->
    </div>
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
