<?php
/**
 * The template for displaying search results pages
 *
 * @package Moridrin
 * @subpackage SSV
 * @since SSV 1.0
 */

get_header(); ?>


<header class="page-header">
    <h1 class="page-title"><?php printf(__('Search Results for: %s', 'ssv'), '<span>' . esc_html(get_search_query()) . '</span>'); ?></h1>
</header><!-- .page-header -->
<div id="page" class="container container">
	<div class="col-xs-12 col-md-9">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
                                      'prev_text'          => __('Previous page', 'ssv'),
                                      'next_text'          => __('Next page', 'ssv'),
                                      'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'ssv') . ' </span>',
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
	<div style="clear: both;"></div>
</div>
<?php get_footer(); ?>
