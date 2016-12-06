<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Moridrin
 * @subpackage SSV
 * @since SSV 1.0
 */
?>
<footer id="colophon" class="site-footer" role="contentinfo" style="margin-bottom: 0;">
	<?php if ( is_active_sidebar( 'content-bottom' ) ) : ?>
		<div class="widget-area footer-widget-area">
			<?php dynamic_sidebar( 'content-bottom' ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>
	<div class="site-info">
		<?php do_action('ssv_credits'); ?>
		Designed and Developed by <a href="<?php echo esc_url(__('http://nl.linkedin.com/in/jberkvens/', 'ssv')); ?>"><?php printf(__('%s', 'ssv'), 'Jeroen Berkvens'); ?></a><br/>
		Proudly powered by <a href="<?php echo esc_url(__('https://wordpress.org/', 'ssv')); ?>"><?php printf(__('%s', 'ssv'), 'WordPress'); ?></a> and <a href="<?php echo esc_url(__('https://www.digitalocean.com/', 'ssv')); ?>"><?php printf(__('%s', 'ssv'), 'DigitalOcean'); ?></a>
	</div>
</footer>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
