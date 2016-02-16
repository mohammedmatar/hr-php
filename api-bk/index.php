<?php
require_once 'models/Model.php';
require_once 'controllers/SalaryCertController.php';
// Requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
	$_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
	$API = new SalaryCertController($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
	echo $API->processAPI();
} catch (Exception $e) {
	echo json_encode(Array('error' => $e->getMessage()));
}

// <----------------------------------------------------------------->

// $method  = $_SERVER['REQUEST_METHOD'];
// $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

// switch ($method) {
// 	case 'PUT':
// 		do_something_with_put($request);
// 		break;
// 	case 'POST':
// 		do_something_with_post($request);
// 		break;
// 	case 'GET':
// 		do_something_with_get($request);
// 		break;
// 	case 'HEAD':
// 		do_something_with_head($request);
// 		break;
// 	case 'DELETE':
// 		do_something_with_delete($request);
// 		break;
// 	case 'OPTIONS':
// 		do_something_with_options($request);
// 		break;
// 	default:
// 		handle_error($request);
// 		break;
// }
// function do_something_with_get($value) {
// 	$value = array('name' => 'name');
// 	exit(json_encode($value));
// }
// function do_something_with_post($value) {
// 	$value = array('name' => 'post');
// 	exit(json_encode($value));
// }
// This is the API, 2 possibilities: show the app list or show a specific app by id.
// This would normally be pulled from a database but for demo purposes, I will be hardcoding the return values.

// function get_app_by_id($id) {
// 	$app_info = array();

// 	// normally this info would be pulled from a database.
// 	// build JSON array.
// 	switch ($id) {
// 		case 1:
// 			$app_info = array("app_name" => "Web Demo", "app_price" => "Free", "app_version" => "2.0");
// 			break;
// 		case 2:
// 			$app_info = array("app_name" => "Audio Countdown", "app_price" => "Free", "app_version" => "1.1");
// 			break;
// 		case 3:
// 			$app_info = array("app_name" => "The Tab Key", "app_price" => "Free", "app_version" => "1.2");
// 			break;
// 		case 4:
// 			$app_info = array("app_name" => "Music Sleep Timer", "app_price" => "Free", "app_version" => "1.9");
// 			break;
// 	}

// 	return $app_info;
// }

// function get_app_list() {
// 	//normally this info would be pulled from a database.
// 	//build JSON array
// 	$app_list = array(array("id" => 1, "name" => "Web Demo"), array("id" => 2, "name" => "Audio Countdown"), array("id" => 3, "name" => "The Tab Key"), array("id" => 4, "name" => "Music Sleep Timer"));

// 	return $app_list;
// }

// $possible_url = array("get_app_list", "get_app");

// $value = "An error has occurred";

// if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url)) {
// 	switch ($_GET["action"]) {
// 		case "GET":
// 			$value = get_app_list();
// 			break;
// 		case "get_app":
// 			if (isset($_GET["id"])) {
// 				$value = get_app_by_id($_GET["id"]);
// 			} else {

// 				$value = "Missing argument";
// 			}

// 			break;
// 	}
// }

// //return JSON array
// exit(json_encode($value));
// ?>