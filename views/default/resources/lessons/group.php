<?php
/**
 * Lists discussions created inside a specific group
 */

$guid = elgg_extract('guid', $vars);
elgg_set_page_owner_guid($guid);

elgg_entity_gatekeeper($guid, 'group');
elgg_group_gatekeeper();

$group = get_entity($guid);

elgg_push_breadcrumb($group->name, $group->getURL());
elgg_push_breadcrumb(elgg_echo('item:object:lessons'));

elgg_register_title_button('lessons', 'add', 'object', 'lessons');

$title = elgg_echo('item:object:lessons');

$options = array(
	'type' => 'object',
	'subtype' => 'lessons',
	'limit' => max(20, elgg_get_config('default_limit')),
	'order_by' => 'e.last_action desc',
	'container_guid' => $guid,
	'full_view' => false,
	'no_results' => elgg_echo('lessons:none'),
	'preload_owners' => true,
);
$content = elgg_list_entities($options);

$params = array(
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('lessons/sidebar'),
	'filter' => '',
);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);