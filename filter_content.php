<?php
function ssv_filter_content($content)
{
	$content = str_replace('<button>', '<button class="btn btn--primary waves-effect waves-light">', $content);
	$content = str_replace('<input type="submit"', '<input type="submit" class="btn btn--primary waves-effect waves-light"', $content);
	$content = str_replace('<input name="submit"', '<input name="submit" class="btn btn--primary waves-effect waves-light"', $content);
    if (strpos($content, '[ssv_test]') !== false) {
        $test = ssv_test_content();
        $content = str_replace('[ssv_test]', $test, $content);
	}
	return $content;
}

function ssv_replace_tag($content, $tag, $url)
{
	$final_content = apply_filters('the_content', explode($tag, $content)[0]);
	ob_start();
    /** @noinspection PhpIncludeInspection */
    require_once get_stylesheet_directory() . $url;
	$final_content .= ob_get_contents();
	ob_end_clean();
	$final_content .= apply_filters('the_content', explode($tag, $content)[1]);
	return $final_content;
}

function ssv_test_content()
{
//	return ssv_register_ssv_frontend_members();
//	return ssv_unregister_ssv_frontend_members();
    return null;
}
