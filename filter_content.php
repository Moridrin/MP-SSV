<?php
function mp_ssv_filter_content($content) {
	$content = str_replace('<button>', '<button class="mui-btn mui-btn--primary">', $content);
	$content = str_replace('<input type="submit"', '<input type="submit" class="mui-btn mui-btn--primary"', $content);
	$content = str_replace('<input name="submit"', '<input name="submit" class="mui-btn mui-btn--primary"', $content);
	$content = str_replace('[test]', test_content(), $content);
	return $content;

	function mp_ssv_replace_tag($content, $tag, $url) {
		$final_content = apply_filters('the_content', explode($tag, $content)[0]);
		ob_start();
		include_once get_stylesheet_directory().$url;
		$final_content .= ob_get_contents();
		ob_end_clean();
		$final_content .= apply_filters('the_content', explode($tag, $content)[1]);
		return $final_content;
	}

	function mp_ssv_members_filter($content) {
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
<?php
function test_content() {
	global $wpdb;
	$table_name = $wpdb->prefix."mp_ssv_mailchimp_merge_fields";
	$merge_fields_to_sync = $wpdb->get_results("SELECT * FROM $table_name");
	ob_start();
	var_dump($merge_fields_to_sync);
	foreach ($merge_fields_to_sync as $row) {
		$row = json_decode(json_encode($row),true);
		if (in_array("preferred_language", $row)) {
			echo "<br/><br/>Success<br/><br/>";
		}
	}
	return ob_get_clean();
}
?>