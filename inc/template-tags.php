<?php

function ssv_entry_meta()
{
    $params               = $_GET;
    $isFullScreen         = filter_var($params['fullscreen'] ?? false, FILTER_VALIDATE_BOOLEAN);
    $params['fullscreen'] = !$isFullScreen;
    ?>
    <div class="post-meta meta-bar">
        <div class="meta-block post-author valign-wrapper">
            <?php echo get_avatar(
                get_the_author_meta('user_email'),
                40,
                '',
                '',
                [
                    'class' => 'circle',
                ]
            ) ?>
        </div>
        <div class="meta-block post-author">
            <a href="<?= esc_url(get_author_posts_url(get_the_author_meta('ID'))) ?>" style="margin-left: 10px;" title="Posts by <?= get_the_author() ?>" rel="author"><?= get_the_author() ?></a>
        </div>
        <div class="meta-block post-comments">
            <i class="fa fa-comment"></i>
            <a href="#"><?= get_comments_number() ?> Comment<?= get_comments_number() == 1 ? '' : 's' ?></a></div>
        <div class="meta-block post-date">
            <i class="fa fa-calendar"></i>
            <span>
                    <a href="<?= get_permalink() ?>" rel="bookmark">
                        <time class="entry-date published updated" datetime="<?php echo esc_attr(get_the_date('c')) ?>"><?php echo get_the_date() ?></time>
                    </a>
                </span>
        </div>
        <div style="height: 100%; float: right;" class="valign-wrapper">
            <a href="<?= $_SERVER['REQUEST_URI'] . '?' . build_query($params) ?>" style="height: 25px;"><i class="material-icons"><?= $isFullScreen ? 'fullscreen_exit' : 'fullscreen' ?></i></a>
        </div>
    </div>

    <?php
}

if (!function_exists('ssv_entry_taxonomies')) :
    function ssv_entry_taxonomies()
    {
        $categories_list = get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'mp-ssv'));
        if ($categories_list && ssv_categorized_blog()) {
            printf(
                '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
                _x('Categories', 'Used before category names.', 'mp-ssv'),
                $categories_list
            );
        }

        $tags_list = get_the_tag_list('', _x(', ', 'Used between list items, there is a space after the comma.', 'mp-ssv'));
        if ($tags_list) {
            printf(
                '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
                _x('Tags', 'Used before tag names.', 'mp-ssv'),
                $tags_list
            );
        }
    }
endif;

if (!function_exists('mp_ssv_post_thumbnail')) :
    function mp_ssv_post_thumbnail($without_link = false, $args = [])
    {
        global $currentBlogId;
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }
        $class = isset($args['class']) ? $args['class'] : '';
        switch (true) {
            case is_archive():
            case is_home():
            case is_category():
            case is_front_page():
                $target = '_self';
                break;
            case $currentBlogId !== get_current_blog_id():
                $target = '_blank';
                break;
            default:
                $target = '_self';
                break;
        }
        if (is_singular()) : ?>
            <div class="post-thumbnail parallax">
                <?php the_post_thumbnail('ssv-banner-xl', ['class' => $class]); ?>
            </div><!-- .post-thumbnail -->
        <?php elseif (!$without_link) : ?>
            <a class="post-thumbnail" href="<?php the_permalink(); ?>" target="<?= $target ?>" aria-hidden="true">
                <?php the_post_thumbnail('ssv-banner-xl', ['alt' => the_title_attribute('echo=0'), 'class' => $class]); ?>
            </a>
        <?php else: ?>
            <?php the_post_thumbnail('ssv-banner-xl', ['alt' => the_title_attribute('echo=0'), 'class' => $class]); ?>
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
            sprintf(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'mp-ssv'), get_the_title(get_the_ID()))
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
            [
                'fields' => 'ids',
                // We only need to know if there is more than one category.
                'number' => 2,
            ]
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
