<?php
/**
 * The template part for displaying content
 *
 * @package Moridrin
 * @subpackage MP-SSV
 * @since MP-SSV 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php echo sprintf('<a href="%s" class="header-link entry-header" rel="bookmark">', esc_url(get_permalink())) ?>
		<header class="entry-header">
			<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
				<span class="sticky-post"><?php _e( 'Featured', 'mpssv' ); ?></span>
			<?php endif; ?>

			<?php the_title('<h2 class="entry-title">', '</h2>'); ?>
		</header><!-- .entry-header -->
	</a>
	<?php mpssv_excerpt(); ?>

	<?php mpssv_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'mpssv' ),
				get_the_title()
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'mpssv' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'mpssv' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php mpssv_entry_meta(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
