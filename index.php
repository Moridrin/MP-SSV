<?php
$birthdayNames = array();

global $wpdb;
$table   = $wpdb->usermeta;
$sql     = "SELECT user_id FROM $table WHERE `meta_key` = 'date_of_birth' AND DATE(CONCAT(YEAR(CURDATE()), RIGHT(`meta_value`, 6))) = CURDATE();";
$results = $wpdb->get_results($sql);
foreach ($results as $result) {
    $birthdayNames[] = get_user_by('id', $result->user_id)->display_name;
}

get_header() ?>
<header class="full-width-entry-header">
    <div class="parallax-container" style="height: 450px; background-color: rgba(0,0,0,0.2);">
        <div class="parallax"><img src="<?php echo count($birthdayNames) > 0 ? get_template_directory_uri() . '/images/birthday.gif' : get_header_image() ?>"></div>
        <div class="valign-wrapper" style="position: absolute; bottom: 0; width: 100%; height: 100%">
            <div class="valign center-align">
                <?php if (count($birthdayNames) > 0): ?>
                    <h2 class="entry-title center-align header-text-color valign">A Very Happy Birthday To:</h2>
                    <?php foreach ($birthdayNames as $birthdayName): ?>
                        <h1 class="entry-title center-align white-text valign"><?php echo $birthdayName ?></h1>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h1 class="entry-title center-align header-text-color valign" style="margin-top: 0; padding-top: 30px;"><?php echo get_bloginfo() ?></h1>
                    <h3 class="entry-title center-align header-text-color valign"><?php echo get_bloginfo('description') ?></h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
<div id="page" class="container <?php echo is_admin_bar_showing() ? 'wpadminbar' : '' ?> large-bar">
    <div class="row">
        <div class="col s12 <?php echo is_dynamic_sidebar() ? 'm8 l9 xl10' : '' ?>">
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                    <?php $welcomeMessage = get_theme_mod('welcome_message', ''); ?>
                    <?php if (!empty($welcomeMessage)): ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="card-panel">
                                <?php echo $welcomeMessage ?>
                            </div>
                        </article>
                    <?php endif; ?>
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
