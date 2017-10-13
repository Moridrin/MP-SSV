<?php get_header() ?>
<div id="page" class="container <?php echo is_admin_bar_showing() ? 'wpadminbar' : '' ?> large-bar">
    <div class="row">
        <div class="col s12 <?php echo is_dynamic_sidebar() ? 'm7 l8 xl9' : '' ?>">
            <h1 class="entry-title center-align valign" style="margin-top: 0; padding-top: 30px;"><?php echo get_bloginfo() ?></h1>
            <h3 class="entry-title center-align valign"><?php echo get_bloginfo('description') ?></h3>
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                    <?php get_template_part('template-parts/content', 'front-page'); ?>
                    <h3>Latest news</h3>
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            get_template_part('template-parts/content', get_post_format());
                        }
                        echo mp_ssv_get_pagination();
                    } else {
                        get_template_part('template-parts/content', 'none');
                    }
                    ?>
                </main>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
