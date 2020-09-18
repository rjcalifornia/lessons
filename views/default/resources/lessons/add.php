<?php

elgg_gatekeeper();

$guid = elgg_extract('guid', $vars);
elgg_require_js("lessons/video_validation");
elgg_entity_gatekeeper($guid);
elgg_group_gatekeeper(true, $guid);

$container = get_entity($guid);

// Make sure user has permissions to add a topic to container
if (!$container->canWriteToContainer(0, 'object', 'lessons')) {
	register_error(elgg_echo('actionunauthorized'));
	forward(REFERER);
}

$title = elgg_echo('lessons:add:lesson');

elgg_push_breadcrumb($container->getDisplayName(), "lessons/owner/{$container->guid}");
elgg_push_breadcrumb($title);
$form_vars = array('enctype' => 'multipart/form-data');
$body_vars = lessons_prepare_form_vars();
$content = elgg_view_form('lessons/save', $form_vars, $body_vars);

$params = array(
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('lessons/sidebar/edit'),
	'filter' => '',
);
$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);