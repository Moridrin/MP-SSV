<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package Moridrin
 * @subpackage MP-SSV
 * @since MP-SSV 1.0
 */

get_header(); ?>

<header class="entry-header">
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
</header><!-- .entry-header -->
<div id="page" class="container mui-container">
	<div class="mui-col-xs-12 mui-col-md-9">
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
