<?php


function get_param($name, $default) {
	if (isset($_GET[$name]))
		return urldecode($_GET[$name]);
	else
		return $default;
}		
function add_param(&$url, $name, $value) {
	$sep = strpos($url, '?') !== false ? '&' : '?';
	$url .= $sep . $name . "=" . urlencode($value);
	return $url;
}
function navigation($language, $pageId) {
	$urlBase = $_SERVER['PHP_SELF'];
	add_param( $urlBase, "lang", $language);
	$navigation=array("home", "products", "info", "contact", "registerForm");
	foreach($navigation as $nav){
		$url = $urlBase;
		add_param( $url, "id", $nav);
		$class = $pageId == $nav ? 'active' : 'inactive';
		echo "<a class=\"$class\" href=\"$url\">$nav</a>";
	}
}

function content($pageId) {
	echo t('content') . " $pageId";
}

function languages($language, $pageId) {
	$languages = array('de','fr', 'en');
	$urlBase = $_SERVER['PHP_SELF'];
	add_param($urlBase, 'id', $pageId);
	foreach( $languages as $lang ) {
		$url = $urlBase;
		$class = $language == $lang ? 'active' : 'inactive';
		echo "<a class=\"$class\" href=\"".add_param($url,'lang', $lang)."\">".strtoupper($lang)."</a>";
	}
}

function loadMessages(){
}

function t($key) {
	global $texts;
	if (isset($texts[$key])) {
		return $texts[$key];
	} else {
		return "[$key]";
	}
}

$language = get_param('lang', 'de');
$pageId = get_param('id', 0);
$texts=array();

$file=file("messages/messages_$language.txt");
foreach($file as $line){                
	list($key, $val) = explode("=", $line);
	$texts[$key]=$val;
}