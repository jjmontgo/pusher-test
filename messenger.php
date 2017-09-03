<?php

include_once 'vendor/autoload.php';
include_once 'secret.php';

$app_id = APP_ID;
$app_key = APP_KEY;
$app_secret = APP_SECRET;
$app_cluster = APP_CLUSTER;

$pusher = new Pusher(
	$app_key,
	$app_secret,
	$app_id,
	array('cluster' => $app_cluster)
);

$pusher->trigger('messaging', 'message', $_REQUEST['messages']);