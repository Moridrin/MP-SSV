<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Moridrin
 * @subpackage MP-SSV
 * @since MP-SSV 1.0
 */
?>
<footer id="colophon" class="site-footer" role="contentinfo" style="margin-bottom: 0;">
	<?php if (has_nav_menu( 'social')) { ?>
	<nav class="social-navigation" role="navigation" aria-label="<?php _e('Footer Social Links Menu', 'mpssv'); ?>">
	<?php
		wp_nav_menu(array(
			'theme_location'	=> 'social',
			'menu_class'		=> 'social-links-menu',
			'depth'				=> 1,
			'link_before'		=> '<span class="screen-reader-text">',
			'link_after'		=> '</span>',
		));
	?>
	</nav>
	<?php } ?>
	<?php if ( is_active_sidebar( 'content-bottom' ) ) : ?>
		<div class="widget-area footer-widget-area">
			<?php dynamic_sidebar( 'content-bottom' ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>
	<div class="site-info">
	<?php do_action('mpssv_credits'); ?>
		Designed and Developed by <a href="<?php echo esc_url(__('http://nl.linkedin.com/in/jberkvens/', 'mpssv')); ?>"><?php printf(__('%s', 'mpssv'), 'Jeroen Berkvens'); ?></a><br/>
		Proudly powered by <a href="<?php echo esc_url(__('https://wordpress.org/', 'mpssv')); ?>"><?php printf(__('%s', 'mpssv'), 'WordPress'); ?></a> and <a href="<?php echo esc_url(__('https://www.digitalocean.com/', 'mpssv')); ?>"><?php printf(__('%s', 'mpssv'), 'DigitalOcean'); ?></a>
	</div>
</footer>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
