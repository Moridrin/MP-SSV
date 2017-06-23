<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
            <?php mp_ssv_post_thumbnail(true, array('class' => 'activator banner')); ?>
        </div>
        <div class="card-content">
            <span class="post-meta post-date">
                <?php the_date('M j, Y') ?>
            </span>
            <div class="post-title">
                <?php if (is_sticky() && is_home() && !is_paged()) : ?>
                    <span class="sticky-post">Featured</span>
                <?php endif; ?>
                <h3><?php echo the_title() ?></h3>
            </div>
            <?php $content = get_the_content(); ?>
            <?php $content = wp_trim_words($content, 50); ?>
            <?php echo $content ?>

        </div>
        <div class="card-action">
            <a href="#" title="Read More" class="read-more">
                Read More <i class="fa fa-long-arrow-right right"></i>
            </a>
        </div>
    </div>
</article>
