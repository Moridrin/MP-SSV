<?php $welcomeMessage = get_theme_mod('welcome_message', ''); ?>
<?php if (!empty($welcomeMessage)): ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php echo $welcomeMessage ?>
    </article>
<?php endif; ?>
<?php for ($i = 0; $i < 4; $i++): ?>
    <?php if (get_theme_mod('home_button_'.$i.'_enabled', true)): ?>
        <div class="col s6 m6 l6 xl3">
            <div>
                <div class="card hover-reveal">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="blurred" src="<?= wp_get_attachment_image_src(get_theme_mod('home_button_'.$i.'_image'), [485,325])[0] ?>" height="325">
                    </div>
                    <a href="<?= get_theme_mod('home_button_'.$i.'_url')?>" class="card-overlay">
                        <h3 class="card-bottom-text"><?= get_theme_mod('home_button_'.$i.'_title')?><i class="tiny material-icons right">arrow_forward</i></h3>
                    </a>
                </div>
            </div>
        </div>
    <?php endif ?>
<?php endfor ?>