<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package Moridrin
 * @subpackage SSV
 * @since SSV 1.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar' )  ) : ?>
	<aside id="secondary" class="sidebar widget-area col s12 <?= is_dynamic_sidebar() ? 'col m4 l3' : '' ?>" role="complementary">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
