<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package    Moridrin
 * @subpackage SSV
 * @since      SSV 1.0
 */
?>

<?php if (is_active_sidebar('sidebar')) : ?>
    <aside id="secondary" class="sidebar col s12 m4 l3 xl2" role="complementary">
        <div class="widget-area-container">
            <div class="widget-area <?php echo is_admin_bar_showing() ? 'wpadminbar' : '' ?>">
                <?php dynamic_sidebar('sidebar'); ?>
            </div>
        </div>
    </aside>
<?php endif; ?>
