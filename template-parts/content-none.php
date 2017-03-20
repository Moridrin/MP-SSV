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

<?php
function ssv_get_search_form($echo = true)
{
    ob_start();
    ?>
    <nav>
        <div class="nav-wrapper">
            <form role="search" method="get" class="search-form" action="/">
                <div class="input-field">
                    <input id="search" type="search" value="<?= get_search_query() ?>" name="s" required>
                    <label for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons">close</i>
                </div>
            </form>
        </div>
    </nav>
    <?php
    $search_form = ob_get_clean();
    if ($echo) {
        echo $search_form;
    }
    return $search_form;
}
