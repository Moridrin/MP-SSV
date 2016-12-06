<?php
/**
 * The template part for displaying single posts
 *
 * @package    Moridrin
 * @subpackage SSV
 * @since      SSV 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(
            array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'ssv') . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . __('Page', 'ssv') . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            )
        );

        if ('' !== get_the_author_meta('description')) {
            get_template_part('template-parts/biography');
        }
        ?>
    </div>
    <?php ssv_entry_meta(); ?>
</article>
