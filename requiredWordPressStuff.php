<?php
/**
 * Created by PhpStorm.
 * User: jeroen
 * Date: 9-2-17
 * Time: 15:17
 */
function requiredWordPress()
{
    ob_start();
    the_posts_pagination();
    if (!isset($content_width)) {
        $content_width = 900;
    }
    $discart = ob_get_clean(); //the_posts_pagination() is a required function.
}