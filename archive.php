<?php
get_header() ?>
    <div id="page" class="container <?php echo is_admin_bar_showing() ? 'wpadminbar' : '' ?>">
        <div class="row">
            <div class="col s12 <?php echo is_dynamic_sidebar() ? 'col m8 l9' : '' ?>">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
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