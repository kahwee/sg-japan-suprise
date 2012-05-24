<?php

require_once 'vendor/autoload.php';
require_once 'config.php';

#Using Facebook's sdk
$facebook = new Facebook(array(
    'appId' => $facebook_app_id,
    'secret' => $facebook_app_secret,
));

#export all the posts:
$result = @$facebook->api('/platform/posts');
$post_ids = array();
if (isset($result['data'])) {
	foreach ($result['data'] as $item) {
		$post_ids[] = $item['id'];
	}
}
export('posts.csv', $result['data']);

#export all the likes:
$likes_data = array();
foreach ($post_ids as $post_id) {
	$likes = @$facebook->api($post_id);
	if (isset($likes['likes'], $likes['likes']['data'])) {
		foreach ($likes['likes']['data'] as $item) {
			$likes_data[] = array(
				'post_id' => $post_id,
				'individual_id' => $item['id'],
				'individual_name' => $item['name'],
			);
		}
	}
}
export("likes.csv", $likes_data);

/**
 * Convenient function to export to right directory.
 */
function export($filename, $data) {
	$fp = fopen('output/' . $filename, 'w');
	foreach ($data as $fields) {
		fputcsv($fp, $fields);
	}
	fclose($fp);
}
