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
    <div class="" >
        <div class="lt-slider slider">
            <ul class="slides" style="height:500px">
                <?php
                $headers = get_uploaded_header_images();
                shuffle($headers);
                ?>
                <?php foreach ($headers as $header): ?>
                <li class="slide">
                    <img src="<?= $header['url'] ?>"/>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</header>
<div id="page" class="container <?php echo is_admin_bar_showing() ? 'wpadminbar' : '' ?> large-bar">
    <div class="row">
        <div class="col s12 <?php echo is_dynamic_sidebar() ? 'm7 l8 xl9' : '' ?>">
            <h1 class="entry-title center-align valign" style="margin-top: 0; padding-top: 30px;"><?php echo get_bloginfo() ?></h1>
            <h3 class="entry-title center-align valign"><?php echo get_bloginfo('description') ?></h3>
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                    <?php $welcomeMessage = get_theme_mod('welcome_message', ''); ?>
                    <?php if (!empty($welcomeMessage)): ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <?php echo $welcomeMessage ?>
                        </article>
                    <?php endif; ?>
                    <?php for ($i = 0; $i < 4; $i++): ?>
                    <?php if (get_theme_mod('home_button_'.$i.'_enabled', true)): ?>
                    <div class="col s6 m6 l6 xl3">
                        <div class="card hover-reveal">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="blurred" src="<?= wp_get_attachment_image_src(get_theme_mod('home_button_'.$i.'_image'), [485,325])[0] ?>" height="325">
                            </div>
                            <div class="card-overlay">
                                <a href="<?= get_theme_mod('home_button_'.$i.'_url')?>" class="card-url"><h3><?= get_theme_mod('home_button_'.$i.'_title')?>&rarr;</h3></a>
                            </div>

                        </div>
                    </div>
                    <?php endif ?>
                    <?php endfor ?>
                    <h3>Latest news</h3>
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
