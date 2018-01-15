<?php

$language = get_param('lang', 'de');
$action = get_param('action', "home");


function redirect($url, $statusCode = 303) {
	header('Location: ' . $url, true, $statusCode);
	die();
}

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
	$navigation = simplexml_load_file(__DIR__."/../xml/navigation.xml");
	$isLoggedIn = false;
	$isAdmin = false;
	if(array_key_exists("isAdmin", $_SESSION)){
		$isAdmin=$_SESSION["isAdmin"];
	}
	if(array_key_exists("isLoggedIn", $_SESSION)){
		$isLoggedIn=$_SESSION["isLoggedIn"];
	}
	$action = get_param('action', "home");
	
	foreach($navigation as $nav){
		if($nav["requiredState"]=="login" && !$isLoggedIn){
			continue;
		}
		if($nav["requiredState"]=="logout" && $isLoggedIn){
			continue;
		}
		if($nav["requiredState"]=="admin" && !$isAdmin){
			continue;
		}
		$url = $urlBase;
		add_param( $url, "action", $nav["actionCall"]);
		add_param( $url, "controller", $nav["controller"]);
		$class = $action == $nav["actionCall"] ? 'active' : 'inactive';
		echo "<a class=\"$class\" href=\"$url\">".$nav["actionCall"]."</a>";
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

$texts=array();

$file=file("messages/messages_$language.txt");
foreach($file as $line){                
	list($key, $val) = explode("=", $line);
	$texts[$key]=$val;
}