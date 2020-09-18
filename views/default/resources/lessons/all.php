<?php

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('lessons'));

$content = elgg_view('lessons/listing/all');

$title = elgg_echo('lessons:latest');

$params = array(
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('lessons/sidebar'),
	'filter' => '',
);
$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);