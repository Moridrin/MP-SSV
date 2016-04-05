<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package Moridrin
 * @subpackage MP-SSV
 * @since MP-SSV 1.0
 */

get_header(); ?>
<header class="full-width-entry-header mui--visible-xs-block">
	<?php the_title( '<h1 class="entry-title mui--z2">', '</h1>' ); ?>
</header><!-- .entry-header -->
<div id="page" class="container mui-container">
	<div class="mui-col-xs-12 <?php if (is_dynamic_sidebar()) { echo "mui-col-md-9"; } ?>">
		<header class="breaking-entry-header mui--hidden-xs">
			<?php the_title( '<h1 class="entry-title mui--z2">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'page' );
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
				?>
			</main>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
