<?php
/**
 * @package    Moridrin
 * @subpackage SSV
 * @since      SSV 1.0
 */

function ssv_entry_meta()
{
    $author_avatar_size = apply_filters('ssv_author_avatar_size', 49);
    ?>
    <footer class="entry-footer">
        <div class="valign-wrapper footer">
            <span style="float: left;">
                <span class="author vcard">
                    <?= get_avatar(
                        get_the_author_meta('user_email'),
                        $author_avatar_size,
                        '',
                        '',
                        array(
                            'class' => 'circle',
                        )
                    ) ?>
                </span>
            </span>
            <div class="valign <?= is_home() ? 'left' : '' ?>">
                <span class="screen-reader-text" style="margin-left: 10px;">Author</span>
                <a class="url fn n" href="<?= esc_url(get_author_posts_url(get_the_author_meta('ID'))) ?>"><?= get_the_author() ?></a>
                <br/>
                <span class="posted-on" style="margin-left: 10px;"><span class="screen-reader-text">Posted on </span><time class="entry-date published updated" datetime="<?= esc_attr(get_the_date('c')) ?>"><?= get_the_date() ?></time></span>
                <br/>
                <span class="tags-links" style="margin-left: 10px;"><span class="screen-reader-text">Categories </span><?= get_the_category_list(', ') ?></span>
            </div>
            <?php if (is_home()): ?>
                <div class="valign" style="margin-left: auto;">
                    <a href="<?= get_permalink() ?>" class="btn waves-effect waves-light right">Full Post</a>
                </div>
            <?php endif; ?>
        </div>
    </footer>
    <?php
}

if (!function_exists('ssv_entry_taxonomies')) :
    function ssv_entry_taxonomies()
    {
        $categories_list = get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'ssv'));
        if ($categories_list && ssv_categorized_blog()) {
            printf(
                '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
                _x('Categories', 'Used before category names.', 'ssv'),
                $categories_list
            );
        }

        $tags_list = get_the_tag_list('', _x(', ', 'Used between list items, there is a space after the comma.', 'ssv'));
        if ($tags_list) {
            printf(
                '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
                _x('Tags', 'Used before tag names.', 'ssv'),
                $tags_list
            );
        }
    }
endif;

if (!function_exists('mp_ssv_post_thumbnail')) :
    function mp_ssv_post_thumbnail($without_link = false, $args = array())
    {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }
        $class = isset($args['class']) ? $args['class'] : '';

        if (is_singular()) : ?>
            <div class="post-thumbnail parallax">
                <?php the_post_thumbnail('ssv-banner-xl', array('class' => $class)); ?>
            </div><!-- .post-thumbnail -->
        <?php elseif (!$without_link) : ?>
            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                <?php the_post_thumbnail('ssv-banner-xl', array('alt' => the_title_attribute('echo=0'), 'class' => $class)); ?>
            </a>
        <?php else: ?>
            <?php the_post_thumbnail('ssv-banner-xl', array('alt' => the_title_attribute('echo=0'), 'class' => $class)); ?>
        <?php endif; // End is_singular()
    }
endif;

if (!function_exists('ssv_excerpt')) :
    function ssv_excerpt($class = 'entry-summary')
    {
        $class = esc_attr($class);

        if (has_excerpt() || is_search()) : ?>
            <div class="<?php echo $class; ?>">
                <?php the_excerpt(); ?>
            </div><!-- .<?php echo $class; ?> -->
        <?php endif;
    }
endif;

if (!function_exists('ssv_excerpt_more') && !is_admin()) :
    function ssv_excerpt_more()
    {
        $link = sprintf(
            '<a href="%1$s" class="more-link">%2$s</a>',
            esc_url(get_permalink(get_the_ID())),
            /* translators: %s: Name of current post */
            sprintf(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'ssv'), get_the_title(get_the_ID()))
        );
        return ' &hellip; ' . $link;
    }

    add_filter('excerpt_more', 'ssv_excerpt_more');
endif;

function ssv_categorized_blog()
{
    if (false === ($all_the_cool_cats = get_transient('ssv_categories'))) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(
            array(
                'fields' => 'ids',
                // We only need to know if there is more than one category.
                'number' => 2,
            )
        );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('ssv_categories', $all_the_cool_cats);
    }

    if ($all_the_cool_cats > 1) {
        // This blog has more than 1 category so ssv_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so ssv_categorized_blog should return false.
        return false;
    }
}

function ssv_category_transient_flusher()
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient('ssv_categories');
}

add_action('edit_category', 'ssv_category_transient_flusher');
add_action('save_post', 'ssv_category_transient_flusher');
