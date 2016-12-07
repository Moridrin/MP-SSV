<?php
/**
 * The template part for displaying content
 *
 * @package    Moridrin
 * @subpackage SSV
 * @since      SSV 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('card panel panel-with-header'); ?>>
    <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
            <?php mp_ssv_post_thumbnail(true, array('class' => 'activator')); ?>
        </div>
        <div class="card-content">
            <header class="entry-header">
                <?php if (is_sticky() && is_home() && !is_paged()) : ?>
                    <span class="sticky-post">Featured</span>
                <?php endif; ?>

                <span class="card-title activator grey-text text-darken-4"><?= the_title() ?></span>
            </header>
            <p><a href="<?= esc_url(get_permalink()) ?>">Full Post</a></p>
        </div>
        <div class="card-reveal">
            <header class="entry-header">
                <?php if (is_sticky() && is_home() && !is_paged()) : ?>
                    <span class="sticky-post">Featured</span>
                <?php endif; ?>

                <span class="card-title activator grey-text text-darken-4"><?= the_title() ?><i class="material-icons right">close</i></span>
            </header>
            <p>
                <?php
                the_content('Full Post');
                ?>
            </p>
        </div>
        <?php ssv_entry_meta(); ?>
    </div>
</article>
