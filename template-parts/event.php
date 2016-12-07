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
                <?php the_content('Full Post'); ?>
            </p>
        </div>
        <div class="card-action">
            <?php if (is_user_logged_in()) : ?>
                <div>
                    <?php if (FrontendMember::get_current_user()->goesToEvent(get_the_ID())) : ?>
                        <a href="<?= get_permalink() . '?register=' . get_current_user_id() ?>" class="register_link">Cancel Registration</a>
                    <?php else : ?>
                        <a href="<?= get_permalink() . '?register=' . get_current_user_id() ?>" class="register_link">Register</a>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <a href="/login">Login</a>
            <?php endif; ?>
        </div>
    </div>
</article>
