<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="card hoverable">
        <div class="card-image waves-effect waves-block waves-light">
            <?php mp_ssv_post_thumbnail(true, array('class' => 'activator banner')); ?>
        </div>
        <div class="card-content">
            <header class="entry-header">
                <?php if (is_sticky() && is_home() && !is_paged()) : ?>
                    <span class="sticky-post">Featured</span>
                <?php endif; ?>
                <h1 class="card-title activator grey-text text-darken-4"><?= the_title() ?></h1>
            </header>
            <?php $content = get_the_content(); ?>
            <?php $content = wp_trim_words($content, 50); ?>
            <?= $content ?>
            <span class="activator link">Read More</span><br/>
            <p><a href="<?= get_permalink() ?>">Full Post</a></p>
        </div>
        <div class="card-reveal">
            <header class="entry-header">
                <?php if (is_sticky() && is_home() && !is_paged()) : ?>
                    <span class="sticky-post">Featured</span>
                <?php endif; ?>

                <h1 class="card-title activator grey-text text-darken-4"><?= the_title() ?><i class="material-icons right">close</i></h1>
            </header>
            <p>
                <?php
                the_content('');
                ?>
            </p>
        </div>
        <?php ssv_entry_meta(); ?>
    </div>
</article>
