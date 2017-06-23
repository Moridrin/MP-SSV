<?php get_header(); ?>
<div id="page" class="container <?php echo is_admin_bar_showing() ? 'wpadminbar' : '' ?>">
    <div class="row">
        <div class="col s12 <?php echo is_dynamic_sidebar() ? 'm7 l8 xxl9' : '' ?>">
            <div id="primary" class="content-area <?php echo strpos(get_the_content(), 'class="card') === false ? 'card' : '' ?>">
                <div class="card-image waves-effect waves-block waves-light">
                    <img src="<?php the_post_thumbnail_url() ?>"/>
                    <div class="card-overlay">
                        <h1 class="page-title"><?= the_title() ?></h1>
                    </div>
                </div>
                <main id="main" class="site-main" role="main">
                    <?php
                    the_post();
                    get_template_part('template-parts/content', 'single');
                    if (comments_open() || get_comments_number()): ?>
                        <div style="padding: 10px;">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>
                </main>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
