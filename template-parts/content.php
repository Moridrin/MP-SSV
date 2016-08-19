<?php
/**
 * The template part for displaying content
 *
 * @package Moridrin
 * @subpackage SSV
 * @since SSV 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card mui-panel mui-panel-with-header'); ?>>
	<?php echo sprintf('<a href="%s" class="card-link header-link entry-header" rel="bookmark"></a>', esc_url(get_permalink())) ?>
		<header class="entry-header">
			<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
                <span class="sticky-post"><?php _e('Featured', 'ssv'); ?></span>
			<?php endif; ?>

			<?php the_title('<h2 class="entry-title">', '</h2>'); ?>
		</header><!-- .entry-header -->
    <?php ssv_excerpt(); ?>

    <?php ssv_post_thumbnail(true); ?>

	<div class="entry-content mui-panel-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
                             __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'ssv'),
                             get_the_title()
			) );

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
	<footer class="entry-footer">
        <?php ssv_entry_meta(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
