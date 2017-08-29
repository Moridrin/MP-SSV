<footer class="page-footer <?php echo is_404() ? '' : 'primary' ?>">
    <div>
        <div class="container footer-container">
            <div class="row">
                <div class="col s12 m8 l9 xl10">
                    <?php echo get_theme_mod('footer_main', '<h3>About the SSV Library</h3><p>The SSV Library started with the website for <a href="https://allterrain.nl/">All Terrain</a> for which a lot of functionality was needed in a format that would be easy enough for everyone to work with.</p>'); ?>
                </div>
                <div class="col s12 m4 l3 xl2">
                    <?php echo get_theme_mod('foorer_right', '<h3>Partners</h3><ul><li><a class="grey-text text-lighten-3 customize-unpreviewable" href="https://allterrain.nl/">All Terrain</a></li><li><a class="grey-text text-lighten-3 customize-unpreviewable" href="http://www.eshdavinci.nl">ESH Da Vinci</a></li><li><a class="grey-text text-lighten-3 customize-unpreviewable" href="https://www.facebook.com/survivalruneindhoven/">Survivalrun Eindhoven</a></li></ul>'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright darken-1">
        <div class="container footer-container" style="white-space: nowrap; padding: 0 10px;">
            &copy; <?php echo date("Y", time()) ?> All Terrain
            <?php if (is_404()): ?>
                <div class="right">
                    <a href="http://apexdesignstudios.com" target="_blank">404 page by Apex Design Studio</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>
</body>
<?php wp_footer(); ?>
