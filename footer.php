<?php
/**
 * The template for displaying the footer
 * Contains the closing of the #content div and all content after
 *
 * @package    Moridrin
 * @subpackage SSV
 * @since      SSV 1.0
 */
?>
<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">About All Terrain</h5>
                <p class="grey-text text-lighten-4">Officially All Terrain was named "Eerste Studenten All Terrain Sportveriging" (ESATS for short) and started in 1991 as the first student outdoor sports club intended for all the non-motorized outdoor sporters.</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Partners</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="https://www.facebook.com/survivalruneindhoven/">Survivalrun Eindhoven</a></li>
                    <li><a class="grey-text text-lighten-3" href="http://eindhoven-studentenstad.nl/">Eindhoven Studentenstad</a></li>
                    <li><a class="grey-text text-lighten-3" href="mailto:Board@AllTerrain.nl">Become a Sponsor</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright darken-1">
        <div class="container">
            © <?= date("Y", time()) ?> Copyright <a href="http://www.dutchconceptgroup.com/" target="_blank">Dutch Concept Group</a>.
            Designed and Developed by <a href="http://nl.linkedin.com/in/jberkvens/" target="_blank">Jeroen Berkvens</a>. Proudly powered by <a href="https://wordpress.org/" target="_blank">WordPress</a> and <a href="https://www.digitalocean.com/" target="_blank">DigitalOcean</a>
            <?php do_action('ssv_credits'); ?>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
