<?php
ssv_entry_meta();
$params = $_GET;
if (isset($params['fullscreen']) && filter_var($params['fullscreen'], FILTER_VALIDATE_BOOLEAN)) {
    $params['fullscreen'] = false;
} else {
    $params['fullscreen'] = true;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div style="float: right;"><a href="?<?= http_build_query($params) ?>">FS</a></div>
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
