<?php

$guid = elgg_extract('guid', $vars);

elgg_register_rss_link();

elgg_entity_gatekeeper($guid, 'object', 'lessons');

$topic = get_entity($guid);

elgg_extend_view('page/elements/head', 'lessons/scripts');

$container = $topic->getContainerEntity();

elgg_require_js('elgg/lessons');

elgg_set_page_owner_guid($container->getGUID());

elgg_group_gatekeeper();

if ($container instanceof ElggGroup) {
	$owner_url = "lessons/group/$container->guid";
} else {
	$owner_url = "lessons/owner/$container->guid";
}

elgg_push_breadcrumb($container->getDisplayName(), $owner_url);
elgg_push_breadcrumb($topic->title);

$params = array(
	'topic' => $topic,
	'show_add_form' => $topic->canWriteToContainer(0, 'object', 'lessons_reply'),
);
$title = $topic->title;

$content = elgg_view_entity($topic, array('full_view' => true));
$content .= elgg_view('lessons/replies', $params);
if ($topic->status == 'closed') {
	$content .= elgg_view('lessons/closed');
}

$body = elgg_view('resources/lessons/elements/lesson_content', array('entity'=>$topic));


echo elgg_view_page($title, $body);

/*
$params = array(
	'content' => $content,
	'title' => $topic->title,
	'sidebar' => elgg_view('lessons/sidebar'),
	'filter' => '',
);
$body = elgg_view_layout('content', $params);

echo elgg_view_page($topic->title, $body);
*/