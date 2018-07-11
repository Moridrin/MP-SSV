<?php
ssv_entry_meta();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(
            array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . 'Pages:' . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . 'Page' . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            )
        )
        ?>
    </div>
</article>
