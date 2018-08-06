<?php
/* Template Name: No Auto <p> */
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'ssv_wpautop');
require_once 'page.php';
