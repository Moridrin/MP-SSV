<?php
function filter_content($content) {
	$content = str_replace('<button>', '<button class="mui-btn mui-btn--primary">', $content);
	$content = str_replace('<input type="submit"', '<input type="submit" class="mui-btn mui-btn--primary"', $content);
	$content = str_replace('<input name="submit"', '<input name="submit" class="mui-btn mui-btn--primary"', $content);
	return $content;

	function replace_tag($content, $tag, $url) {
		$final_content = apply_filters('the_content', explode($tag, $content)[0]);
		ob_start();
		include_once get_stylesheet_directory().$url;
		$final_content .= ob_get_contents();
		ob_end_clean();
		$final_content .= apply_filters('the_content', explode($tag, $content)[1]);
		return $final_content;
	}

	function members_filter($content) {
		$users = get_users();
		foreach ($users as $user) {
			$search_term = $user->user_firstname." ".$user->user_lastname;
			$search_replace = '<a href="/profile/?user_id='.$user->ID.'">'.$user->user_firstname.' '.$user->user_lastname.'</a>';
			if (!is_null($search_term) && isset($search_term) && $search_term != "" && $search_term != " ") {
				$content = str_replace('="'.$search_term.'"', '#TMP_REPLACE#', $content);
				$content = str_replace($search_term, $search_replace, $content);
				$content = str_replace('#TMP_REPLACE#', '="'.$search_term.'"', $content);
			}
		}
		return $content;
	}
}
?>
