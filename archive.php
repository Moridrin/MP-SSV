<?php
get_header(); ?>
<div id="page" class="container mui-container">
	<div class="mui-col-xs-12 <?php if (is_dynamic_sidebar()) { echo "mui-col-md-9"; } ?>">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				// End the loop.
				endwhile;

				// Previous/next page navigation.
				the_posts_pagination( array(
					'prev_text'          => __( 'Previous page', 'mpssv' ),
					'next_text'          => __( 'Next page', 'mpssv' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'mpssv' ) . ' </span>',
				) );

			// If no content, include the "No posts found" template.
			else :
				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

			</main><!-- .site-main -->
		</div><!-- .content-area -->
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
