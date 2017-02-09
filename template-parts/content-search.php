<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a href="<?= esc_url(get_permalink()) ?>" class="header-link entry-header" rel="bookmark">
        <header class="entry-header">
            <?php if (is_sticky() && is_home() && !is_paged()) : ?>
                <span class="sticky-post">Featured</span>
            <?php endif; ?>
            <?php the_title('<h2 class="entry-title">', '</h2>'); ?>
        </header>
    </a>
    <?php mp_ssv_post_thumbnail(); ?>
    <?php ssv_excerpt(); ?>
    <?php ssv_entry_meta(); ?>
</article>
