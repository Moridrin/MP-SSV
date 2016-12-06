<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package    Moridrin
 * @subpackage SSV
 * @since      SSV 1.0
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title">Nothing Found</h1>
    </header>
    <div class="page-content">
        <?php if (is_home() && current_user_can('publish_posts')) : ?>
            <p>Ready to publish your first post? <a href="<?= esc_url(admin_url('post-new.php')) ?>">Get started here</a></p>
        <?php elseif (is_search()) : ?>
            <p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
            <?php ssv_get_search_form(); ?>
        <?php else : ?>
            <p>It seems we can't find what you're looking for. Perhaps searching can help.</p>
            <?php ssv_get_search_form(); ?>
        <?php endif; ?>
    </div>
</section>