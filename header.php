<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package Moridrin
 * @subpackage MP-SSV
 * @since MP-SSV 1.0
 */
?>
	<html <?php language_attributes(); ?> class="no-js">

	<head>
		<?php wp_head(); ?>
        <script src="js/mui.js"></script>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>
		<script src="https://code.jquery.com/jquery-2.2.0.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	</head>
	<header <?php if (is_admin_bar_showing()) { echo 'style="top: 32px"'; } ?> class="mui-appbar mui--z3 mui--hidden-xs">
		<div class="mui-container">
			<table width="100%">
				<tbody>
					<tr class="mui--appbar-height">
						<td class="site-branding mui--text-title">
							<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php bloginfo('name'); ?>
							</a>
							<?php
							$description = get_bloginfo('description', 'display');
							if ($description || is_customize_preview()) { ?>
								<p class="site-description mui--hidden-xs mui--hidden-sm">
									<?php echo $description; ?>
								</p>
							<?php } ?>
						</td>
						<td align="right">
							<?php
							wp_nav_menu(array(
								'theme_location' => 'primary',
								'menu_class'     => 'primary-menu mui-list--inline mui--text-body2',
								'items_wrap'     => '<ul style="line-height: 64px;" id="%1$s" class="%2$s">%3$s</ul>',
							));
							?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</header>
	<header style="<?php if (is_admin_bar_showing()) { echo ' top: 46px;'; } ?>" class="mui-appbar mui--z3 mui--visible-xs-block">
		<div class="mui-container">
						<div align="center" class="site-branding-center">
							<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php bloginfo('name'); ?>
							</a>
							<?php
						$description = get_bloginfo('description', 'display');
						if ($description || is_customize_preview()) {
							?>
								<p class="site-description mui--hidden-xs mui--hidden-sm">
									<?php echo $description; ?>
								</p>
							<?php } ?>
						</div>
						<div style="float: left;">
							<section class="material-design-hamburger">
								<button class="material-design-hamburger__icon">
									<span class="material-design-hamburger__layer"></span>
								</button>
							</section>
							<section class="menu-container">
								<div class="menu menu--off">
									<?php
									wp_nav_menu(array(
										'theme_location' => 'primary',
										'menu_class'     => 'primary-menu mui-list--unstyled mui--text-body2 mobile-menu',
										'items_wrap'     => '<ul style="line-height: 48px;" id="%1$s" class="%2$s">%3$s</ul>',
									));
									?>
								</div>
							</section>
							<script>
								(function() {
									'use strict';
									document.querySelector('.material-design-hamburger__icon').addEventListener(
										'click',
										function() {
											var child;
											document.body.classList.toggle('background--blur');
											this.parentNode.nextElementSibling.childNodes[1].classList.toggle('menu--on');
											child = this.childNodes[1].classList;
											if (child.contains('material-design-hamburger__icon--to-arrow')) {
												child.remove('material-design-hamburger__icon--to-arrow');
												child.add('material-design-hamburger__icon--from-arrow');
											} else {
												child.remove('material-design-hamburger__icon--from-arrow');
												child.add('material-design-hamburger__icon--to-arrow');
											}
										});
								})();
							</script>
						</div>
		</div>
	</header>