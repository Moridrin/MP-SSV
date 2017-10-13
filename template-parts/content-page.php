<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php
        if (!has_post_thumbnail())
        {
            the_title('<h1>', '</h1>');
        }
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
        );
        ?>
    </div>
</article>
