<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package    Moridrin
 * @subpackage SSV
 * @since      SSV 1.0
 */

get_header() ?>
<header class="full-width-entry-header">
    <div class="parallax-container primary" style="height: 150px;">
        <div class="shade darken-1 valign-wrapper" style="height: 100%">
            <h1 class="entry-title center-align white-text valign">404 Page Not Found</h1>
        </div>
    </div>
</header>
<div id="page" class="container <?= is_admin_bar_showing() ? 'wpadminbar' : '' ?>">
    <div class="col-xs-12 col-md-9">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div class="sand"></div>
                <div class="bb8">
                    <div class="antennas">
                        <div class="antenna short"></div>
                        <div class="antenna long"></div>
                    </div>
                    <div class="head">
                        <div class="stripe one"></div>
                        <div class="stripe two"></div>
                        <div class="eyes">
                            <div class="eye one"></div>
                            <div class="eye two"></div>
                        </div>
                        <div class="stripe three"></div>
                    </div>
                    <div class="ball">
                        <div class="lines one"></div>
                        <div class="lines two"></div>
                        <div class="ring one"></div>
                        <div class="ring two"></div>
                        <div class="ring three"></div>
                    </div>
                    <div class="shadow"></div>
                </div>
            </main><!-- .site-main -->
        </div><!-- .content-area -->
    </div>
</div>
<?php get_footer(); ?>
