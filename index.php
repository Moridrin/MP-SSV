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
    <div class="parallax-container" style="height: 450px;">
        <div class="parallax"><img src="<?= get_theme_root_uri() . '/mp-ssv/images/banner.jpg' ?>"></div>
        <div class="valign-wrapper" style="position: absolute; bottom: 0; width: 100%; height: 100%">
            <div class="valign center-align">
                <h1 class="entry-title center-align white-text valign" style="margin-top: 0; padding-top: 30px"><?= get_bloginfo() ?></h1>
                <h3 class="entry-title center-align white-text valign"><?= get_bloginfo('description') ?></h3>
            </div>
        </div>
    </div>
</header>
<div id="page" class="container <?= is_admin_bar_showing() ? 'wpadminbar' : '' ?>">
    <div class="row">
        <div class="col s12 <?= is_dynamic_sidebar() ? 'm8 l9 xl10' : '' ?>">
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="card-panel hoverable">
                            Welcome to the website of All Terrain. We are a sports association which focusses mainly on outdoor sports. We do mountainbiking, running, climbing, mountaineering, canoeing and orienteering. We train up to three times a week, mountain biking or orienteering on monday and <a href="/what-is-a-survivalrun">survivalrun</a> training on wednesday.
                            <br>
                            Besides training we also organize many weekends in which we go camping somewhere out in nature. Furthermore we sometimes organize courses on climbing techniques, knotting, canoeing or bushcraft.
                            <br>
                            Do you like being active outdoors, do you want to work on your condition and would you rather become strong by doing climbing rather than sitting inside in the gym? Then come and join one of our <a href="/training-sessions/">trainings</a>!
                        </div>
                    </article>
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            get_template_part('template-parts/content', get_post_format());
                        }
                        echo mp_ssv_get_pagination();
                    } else {
                        get_template_part('template-parts/content', 'none');
                    }
                    ?>
                </main>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
