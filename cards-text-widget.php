<?php


if (!defined('ABSPATH')) {
    exit;
}

class ssv_text_cards extends WP_Widget
{

    #region Construct
    public function __construct()
    {
        $widget_ops = array(
            'classname'                   => 'widget_text_cards',
            'description'                 => 'A text field that expects the content to have one or multiple implementations of the "card" class.',
            'customize_selective_refresh' => true,
        );
        parent::__construct('text_cards', 'Text (with Cards)', $widget_ops);
    }
    #endregion

    #region Widget
    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
        $text = apply_filters('widget_text', $instance['text'], $instance, $this->id_base);

        echo $args['before_widget'];
        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        echo $text;
        echo $args['after_widget'];
    }
    #endregion

    #region Update
    public function update($new_instance, $old_instance)
    {
        $instance          = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['text'] = $new_instance['text'];

        return $instance;
    }
    #endregion

    #region Form
    public function form($instance)
    {
        //Defaults
        $instance = wp_parse_args((array)$instance, array('title' => '', 'text' => ''));
        $title    = $instance['title'];
        $text     = $instance['text'];
        ?>
        <p>
            <label for="<?= esc_html($this->get_field_id('title')) ?>">Title:</label>
            <input class="widefat" id="<?= esc_html($this->get_field_id('title')) ?>" name="<?= esc_html($this->get_field_name('title')) ?>" type="text" value="<?= esc_html($title) ?>"/>
        </p>
        <p>
            <label for="<?= esc_html($this->get_field_id('text')) ?>">Title:</label>
            <textarea class="widefat materialize-textarea" rows="16" cols="20" id="<?= esc_html($this->get_field_id('text')) ?>" name="<?= esc_html($this->get_field_name('text')) ?>"><?= esc_html($text) ?></textarea>
        </p>
        <?php
    }
    #endregion

}

add_action('widgets_init', function() { return register_widget("ssv_text_cards"); });
