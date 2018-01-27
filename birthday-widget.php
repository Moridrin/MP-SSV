<?php


if (!defined('ABSPATH')) {
    exit;
}

class ssv_birthdays extends WP_Widget
{

        public function __construct()
    {
        $widget_ops = array(
            'classname'                   => 'widget_birthdays',
            'description'                 => 'A widget which shows whenever a member has a birthday',
            'customize_selective_refresh' => true,
        );
        parent::__construct('birthdays', 'Birthdays', $widget_ops);
    }

        public function widget($args, $instance)
    {
        $birthdayNames = array();

        global $wpdb;
        $table   = $wpdb->usermeta;
        $sql     = "SELECT user_id FROM $table WHERE `meta_key` = 'date_of_birth' AND DATE(CONCAT(YEAR(CURDATE()), RIGHT(`meta_value`, 6))) = CURDATE();";
        $results = $wpdb->get_results($sql);
        foreach ($results as $result) {
            $birthdayNames[] = get_user_by('id', $result->user_id)->display_name;
        }
        if (!empty($birthdayNames)) {
            ?>
            <div class="birthday">
                <div class="parallax-container" style="height: 150px; background-color: rgba(0,0,0,0.2);">
                    <div class="parallax">
                        <img src="<?= get_template_directory_uri() . '/images/birthday.gif'?>"/>
                    </div>

                    <div class="valign center-align" style="width: 100%;">
                        <h5 class="entry-title valign">A Very Happy Birthday To:</h5>
                        <?php foreach ($birthdayNames as $birthdayName): ?>
                            <h4 class="entry-title white-text valign"><?php echo $birthdayName ?></h4>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>


            <?php
        }
    }

        public function update($new_instance, $old_instance)
    {
        return $old_instance;
    }

        public function form($instance)
    {

    }

}

function ssv_material_init_birthday_widget() {
    register_widget('ssv_birthdays');
}
add_action('widgets_init', 'ssv_material_init_birthday_widget');
