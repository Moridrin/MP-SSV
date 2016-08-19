<?php
/**
 * The template used for displaying page content
 *
 * @package Moridrin
 * @subpackage SSV
 * @since SSV 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php ssv_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
                           'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'ssv') . '</span>',
                           'after'       => '</div>',
                           'link_before' => '<span>',
                           'link_after'  => '</span>',
                           'pagelink'    => '<span class="screen-reader-text">' . __('Page', 'ssv') . ' </span>%',
                           'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
