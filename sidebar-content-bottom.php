<?php
/**
 * The template for the content bottom widget areas on posts and pages
 *
 * @package Moridrin
 * @subpackage SSV
 * @since SSV 1.0
 */

// If we get this far, we have widgets. Let's do this.
if ( is_active_sidebar( 'content-bottom' ) ) : ?>
	<div class="widget-area">
		<?php dynamic_sidebar( 'content-bottom' ); ?>
	</div><!-- .widget-area -->
<?php endif; ?>
