<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package Moridrin
 * @subpackage SSV
 * @since SSV 1.0
 */

get_header(); ?>
<header class="full-width-entry-header visible-xs-block">
	<?php the_title( '<h1 class="entry-title z2">', '</h1>' ); ?>
</header><!-- .entry-header -->
<div id="page" class="container container">
	<div class="col-xs-12 <?php if (is_dynamic_sidebar()) { echo "col-md-9"; } ?>">
		<header class="breaking-entry-header hidden-xs">
			<?php the_title( '<h1 class="entry-title z2">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();

					// Include the single post content template.
					get_template_part( 'template-parts/content', 'single' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}

					// End of the loop.
				endwhile;
				?>

			</main><!-- .site-main -->
		</div><!-- .content-area -->
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
