<?php
/**
 * The template part for displaying results in search pages
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

	<?php mp_ssv_post_thumbnail(); ?>

	<?php mp_ssv_excerpt(); ?>

	<?php if ( 'post' === get_post_type() ) : ?>

		<footer class="entry-footer">
			<?php mp_ssv_entry_meta(); ?>
		</footer><!-- .entry-footer -->

	<?php endif; ?>
</article><!-- #post-## -->

