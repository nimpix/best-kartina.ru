<?php

/* =======================================================
 Дополнение: AJAX Fullstory
----------------------------------------------------------
 Copyright (c) 2013 Firstvector.org, BR0kEN
----------------------------------------------------------
 Файл: fullstory.php, версия: 1.0 от 13 января 2013
----------------------------------------------------------
 Загрузка полной новости с использованием AJAX
======================================================= */

@error_reporting ( E_ALL ^ E_WARNING ^ E_NOTICE );
@ini_set('display_errors', true);
@ini_set('html_errors', false);
@ini_set('error_reporting', E_ALL ^ E_WARNING ^ E_NOTICE);

define('DATALIFEENGINE', true);
define('ROOT_DIR', substr(dirname(  __FILE__ ), 0, -12));
define('ENGINE_DIR', ROOT_DIR . '/engine');

include ENGINE_DIR . '/data/config.php';

if ($config['http_home_url'] == "") {
	$config['http_home_url'] = explode("engine/ajax/fullstory.php", $_SERVER['PHP_SELF']);
	$config['http_home_url'] = reset($config['http_home_url']);
	$config['http_home_url'] = "http://" . $_SERVER['HTTP_HOST'] . $config['http_home_url'];
}

require_once ENGINE_DIR . '/classes/mysql.php';
require_once ENGINE_DIR . '/data/dbconfig.php';
require_once ENGINE_DIR . '/modules/functions.php';
require_once ENGINE_DIR . '/modules/sitelogin.php';

// session
if (floatval($config['version_id']) <= 9.7) @session_start();
else dle_session();

// get lang
if ($config["lang_" . $_REQUEST['skin']]) {
	if (file_exists(ROOT_DIR . '/language/' . $config["lang_" . $_REQUEST['skin']] . '/website.lng')) {
		@include_once(ROOT_DIR . '/language/' . $config["lang_" . $_REQUEST['skin']] . '/website.lng');
	} else die("Language file not found");
} else {
	@include_once ROOT_DIR . '/language/' . $config['langs'] . '/website.lng';
}

$config['charset'] = ($lang['charset'] != '') ? $lang['charset'] : $config['charset'];

// params
$news_id = intval($_POST['id']);
$user_tpl = trim($_POST['template']);

// start timer
$show_time = trim($_POST['time']);
if ($show_time !== '') $time_start = microtime(true);

// no finded news
if (!$news_id) die($lang['all_err_1']);

// read cache
$row = dle_cache("af_" . $news_id, $news_id);

// create cache or db query
if($row) {
	$row = unserialize($row);
} else {
	if (floatval($config['version_id']) <= 9.6) $q = "SELECT * FROM " . PREFIX . "_post WHERE id='{$news_id}'";
	else $q = "SELECT * FROM ". PREFIX ."_post p LEFT JOIN " . PREFIX . "_post_extras e ON (p.id=e.news_id) WHERE p.id='{$news_id}'";

	$row = $db->super_query($q);

	create_cache("af_" . $news_id, serialize($row), $news_id);
}

// get category
$cat_info = get_vars("category");

if (!is_array($cat_info)) {
    $cat_info = array();

    $db->query("SELECT * FROM " . PREFIX . "_category ORDER BY posi ASC");
    while ($row = $db->get_row()) {

        $cat_info[$row['id']] = array();

        foreach ($row as $key => $value) {
            $cat_info[$row['id']][$key] = stripslashes($value);
        }
    }
    set_vars("category", $cat_info);
    $db->free();
}

$category_id = intval($row['category']);

if ($user_tpl != '') $tpl_name = $user_tpl . '.tpl';
elseif ($category_id AND $cat_info[$category_id]['af_tpl'] != '') $tpl_name = $cat_info[$row['category']]['af_tpl'] . '.tpl';
else $tpl_name = "fullstory_ajax.tpl";

// Если в cookie есть выбранный шаблон
if (isset ( $_COOKIE['dle_skin'] ) ) {
	$_COOKIE['dle_skin'] = trim( totranslit($_COOKIE['dle_skin'], false, false) );
	if ($_COOKIE['dle_skin'] != '' AND @is_dir ( ROOT_DIR . '/templates/' . $_COOKIE['dle_skin'] )) {
		$config['skin'] = $_COOKIE['dle_skin'];
	}
}
// Если в cookie есть выбранный шаблон

if (!$template = file_get_contents(ROOT_DIR . "/templates/{$config['skin']}/{$tpl_name}")) die($lang['templ_err_1'] ." ". $tpl_name . " " . $lang['templ_err_2']);

// get full
$full_story = stripslashes($row['full_story']);

// get usergroup
$user_group = get_vars("usergroup");

if(!$user_group) {
	$user_group = array ();
	
	$db->query("SELECT * FROM " . USERPREFIX . "_usergroups ORDER BY id ASC");
	
	while ($row = $db->get_row()) {
		
		$user_group[$row['id']] = array ();
		
		foreach ($row as $key => $value) {
			$user_group[$row['id']][$key] = stripslashes($value);
		}
	
	}
	set_vars("usergroup", $user_group);
	$db->free();
}

// check sample
if (strlen($full_story) < 13) $full_story = $row['short_story'];

// rating
// if ($row['allow_rate'] AND $user_group[$member_id['user_group']]['allow_rating']) $rating = ShowRating($row['id'], $row['rating'], $row['vote_num'], 1);

// hide
if ($user_group[$member_id['user_group']]['allow_hide']) $full_story = str_ireplace("[hide]", "", str_ireplace("[/hide]", "", $full_story));
else $full_story = preg_replace("#\[hide\](.+?)\[/hide\]#ims", "<div class=\"quote\">{$lang['bb_t_hide']}</div>", $full_story);

// category name & link
if (!$row['category']) {
	$my_cat = "---";
	$my_cat_link = "---";
} else {
	$my_cat = array();
	$my_cat_link = array();
	$cat_list = explode(',', $row['category']);

	if (count($cat_list) == 1) {

		$my_cat[] = $cat_info[$cat_list[0]]['name'];
		$my_cat_link = get_categories($cat_list[0]);
	} else {
		foreach ($cat_list as $element) {
			
			if ($element) {
				$my_cat[] = $cat_info[$element]['name'];
				if ($config['allow_alt_url'] == "yes") $my_cat_link[] = "<a href=\"" . $config['http_home_url'] . get_url($element) . "/\">{$cat_info[$element]['name']}</a>";
				else $my_cat_link[] = "<a href=\"$PHP_SELF?do=cat&amp;category={$cat_info[$element]['alt_name']}\">{$cat_info[$element]['name']}</a>";
			}
		}

		$my_cat_link = implode(', ', $my_cat_link);

	}

	$my_cat = implode(', ', $my_cat);
	
	if ($category_id) $template = str_replace('{category-url}', $my_cat_link, $template);
	else $template = str_replace('{category-url}', "#", $template);
	
	$template = str_replace('{category-name}', $my_cat, $template);
}

// title
$template = str_replace('{title}', $row['title'], $template);

// full limit
if (preg_match("#\\{full-story limit=['\"](.+?)['\"]\\}#i", $template, $matches)) {
	$count = intval($matches[1]);

	$full_story = str_replace("</p><p>", " ", $full_story);
	$full_story = strip_tags($full_story, "<br>");
	$full_story = trim(str_replace("<br>", " ", str_replace("<br />", " ", str_replace("\n", " ", str_replace("\r", "", $full_story)))));

	if ($count AND dle_strlen($full_story, $config['charset']) > $count) {

		$full_story = dle_substr($full_story, 0, $count, $config['charset']);

		if (($temp_dmax = dle_strrpos($full_story, ' ', $config['charset']))) $full_story = dle_substr($full_story, 0, $temp_dmax, $config['charset']);

	}

	$template = str_replace($matches[0], "<div id=\"news-id-" . $row['id'] . "\" style=\"display:inline;\">" . $full_story . "</div>", $template);

} else $template = str_replace('{full-story}', $full_story, $template);

// full link
if ($config['allow_alt_url'] == "yes") {
	if ($config['seo_type'] == 1 OR $config['seo_type'] == 2) {
		if ($category_id AND $config['seo_type'] == 2) {
			$c_url = get_url($category_id);				
			$full_link = $config['http_home_url'] . $c_url . "/" . $row['id'] . "-" . $row['alt_name'] . ".html";
			$row['alt_name'] = $row['id'] . "-" . $row['alt_name'];
		} else {
			$full_link = $config['http_home_url'] . $row['id'] . "-" . $row['alt_name'] . ".html";
			$row['alt_name'] = $row['id'] . "-" . $row['alt_name'];			
		}
	} else $full_link = $config['http_home_url'] . date( 'Y/m/d/', $row['date'] ) . $row['alt_name'] . ".html";
} else $full_link = $config['http_home_url'] . "index.php?newsid=" . $row['id'];

$template = str_replace('{full-link}', $full_link, $template);
$template = str_replace('[full-link]', "<a href=\"" . $full_link . "\">", $template);
$template = str_replace('[/full-link]', "</a>", $template);

// full-image-x
if (stripos($template, "{full-image-") !== false) {
	$images = array();

	preg_match_all('/(img|src)=("|\')[^"\'>]+/i', $row['full_story'], $media);
	$data = preg_replace('/(img|src)("|\'|="|=\')(.*)/i',"$3", $media[0]);

	foreach ($data as $url) {
		$info = pathinfo($url);
		if (isset($info['extension'])) {
			$info['extension'] = strtolower($info['extension']);
			if (($info['extension'] == 'jpg') || ($info['extension'] == 'jpeg') || ($info['extension'] == 'gif') || ($info['extension'] == 'png')) array_push($images, $url);
		}
	}

	if (count($images)) {
		$i=0;
		foreach ($images as $url) {
			$i++;
			$template = str_replace('{full-image-'.$i.'}', $url, $template);
			$template = str_replace('[full-image-'.$i.']', "", $template);
			$template = str_replace('[/full-image-'.$i.']', "", $template);
		}
	}

	$template = preg_replace("#\[full-image-(.+?)\](.+?)\[/full-image-(.+?)\]#is", "", $template);
	$template = preg_replace("#\\{full-image-(.+?)\\}#i", "{THEME}/dleimages/no_image.jpg", $template);
}

// image-x
if (stripos($template, "{image-") !== false) {
	$images = array();

	preg_match_all('/(img|src)=("|\')[^"\'>]+/i', $row['short_story'], $media);
	$data = preg_replace('/(img|src)("|\'|="|=\')(.*)/i',"$3", $media[0]);

	foreach ($data as $url) {
		$info = pathinfo($url);
		if (isset($info['extension'])) {
			$info['extension'] = strtolower($info['extension']);
			if (($info['extension'] == 'jpg') || ($info['extension'] == 'jpeg') || ($info['extension'] == 'gif') || ($info['extension'] == 'png')) array_push($images, $url);
		}
	}

	if (count($images)) {
		$i=0;
		foreach ($images as $url) {
			$i++;
			$template = str_replace('{image-'.$i.'}', $url, $template);
			$template = str_replace('[image-'.$i.']', "", $template);
			$template = str_replace('[/image-'.$i.']', "", $template);
		}
	}

	$template = preg_replace("#\[image-(.+?)\](.+?)\[/image-(.+?)\]#is", "", $template);
	$template = preg_replace("#\\{image-(.+?)\\}#i", "{THEME}/dleimages/no_image.jpg", $template);
}

// xfields
if (strpos($template, "[xfvalue_") !== false OR strpos($template, "[xfgiven_") !== false) {
	$xfound = true;
	$xfields = xfieldsload();
}
else $xfound = false;

if ($xfound) {
	$xfieldsdata = xfieldsdataload($row['xfields']);

	foreach ($xfields as $value) {
		$preg_safe_name = preg_quote($value[0], "'");

		if ($value[6] AND !empty($xfieldsdata[$value[0]])) {
			$temp_array = explode(",", $xfieldsdata[$value[0]]);
			$value3 = array();

			foreach ($temp_array as $value2) {
				$value2 = trim($value2);
				$value2 = str_replace("&#039;", "'", $value2);

				if ($config['allow_alt_url'] == "yes") $value3[] = "<a href=\"" . $config['http_home_url'] . "xfsearch/" . urlencode( $value2 ) . "/\">" . $value2 . "</a>";
				else $value3[] = "<a href=\"$PHP_SELF?do=xfsearch&amp;xf=" . urlencode($value2) . "\">" . $value2 . "</a>";
			}

			$xfieldsdata[$value[0]] = implode(", ", $value3);

			unset($temp_array);
			unset($value2);
			unset($value3);

		}

		if (empty($xfieldsdata[$value[0]])) {
			$template = preg_replace("'\\[xfgiven_{$preg_safe_name}\\](.*?)\\[/xfgiven_{$preg_safe_name}\\]'is", "", $template);
			$template = str_replace("[xfnotgiven_{$value[0]}]", "", $template);
			$template = str_replace("[/xfnotgiven_{$value[0]}]", "", $template);
		} else {
			$template = preg_replace("'\\[xfnotgiven_{$preg_safe_name}\\](.*?)\\[/xfnotgiven_{$preg_safe_name}\\]'is", "", $template);
			$template = str_replace("[xfgiven_{$value[0]}]", "", $template);
			$template = str_replace("[/xfgiven_{$value[0]}]", "", $template);
		}

		$xfieldsdata[$value[0]] = stripslashes( $xfieldsdata[$value[0]] );

		if (preg_match("#\\[xfvalue_{$preg_safe_name} limit=['\"](.+?)['\"]\\]#i", $template, $matches)) {
			$count = intval($matches[1]);

			$xfieldsdata[$value[0]] = str_replace( "</p><p>", " ", $xfieldsdata[$value[0]] );
			$xfieldsdata[$value[0]] = strip_tags( $xfieldsdata[$value[0]], "<br>" );
			$xfieldsdata[$value[0]] = trim(str_replace( "<br>", " ", str_replace( "<br />", " ", str_replace( "\n", " ", str_replace( "\r", "", $xfieldsdata[$value[0]] ) ) ) ));

			if ($count AND dle_strlen($xfieldsdata[$value[0]], $config['charset']) > $count) {

				$xfieldsdata[$value[0]] = dle_substr($xfieldsdata[$value[0]], 0, $count, $config['charset']);

				if (($temp_dmax = dle_strrpos($xfieldsdata[$value[0]], ' ', $config['charset']))) $xfieldsdata[$value[0]] = dle_substr($xfieldsdata[$value[0]], 0, $temp_dmax, $config['charset']);

			}

			$template = str_replace($matches[0], $xfieldsdata[$value[0]], $template);

		} else $template = str_replace("[xfvalue_{$value[0]}]", $xfieldsdata[$value[0]], $template);

	}
}

$template = str_replace("{THEME}", "templates/{$config['skin']}", $template);

$template = str_replace("{news-id}", $news_id, $template);


// attachment
if ($config['files_allow'] == "yes") if (strpos($template, "[attachment=") !== false) {
	$template = show_attach($template, $news_id);
}

$db->query( "UPDATE " . PREFIX . "_post_extras SET news_read=news_read+1 WHERE news_id='{$row['id']}'" );


// set header
@header("Content-type: text/xml; charset={$config['charset']}");

// go
echo '<?xml version="1.0" encoding="' . $config['charset'] . '"?>'.
'<result>
	<title><![CDATA['. $row['title'] .']]></title>
	<full><![CDATA['. $template .']]></full>
	<link><![CDATA['. $full_link .']]></link>';
echo '</result>';

?>