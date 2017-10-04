<?php get_header(); ?>
<div id="page" class="container <?php echo is_admin_bar_showing() ? 'wpadminbar' : '' ?>">
    <div class="row">
        <div class="col s12 <?php echo is_dynamic_sidebar() ? 'm7 l8 xxl9' : '' ?>">
            <div id="primary" class="content-area <?php echo strpos(get_the_content(), 'class="card') === false ? 'card' : '' ?>">
                <div class="card-image" style="">
                    <?php if (has_post_thumbnail()): ?>
                    <img src="<?php the_post_thumbnail_url('ssv-banner-s') ?>" style="width: auto; margin-left: auto; margin-right: auto;"/>
                    <?php else: ?>
                    <div class="thumbnail-placeholder"></div>
                    <?php endif ?>
                    <div class="card-overlay hide-on-small">
                        <div class="page-title valign-wrapper"><h1><?= the_title() ?></h1></div>
                    </div>
                </div>
                <main id="main" class="site-main" role="main">
                    <?php
                    the_post();
                    get_template_part('template-parts/content', 'single');
                    ?>
                </main>
            </div>
            <?php if (comments_open() || get_comments_number()): ?>
            <?php comments_template(); ?>
            <?php endif; ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
