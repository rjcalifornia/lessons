<?php
/**
 * Latest forum posts
 *
 * @uses $vars['entity']
 */

if ($vars['entity']->lessons_enable == 'no') {
	return true;
}

$group = $vars['entity'];

$page_owner = $group->owner_guid;


$all_link = elgg_view('output/url', array(
	'href' => "lessons/owner/$group->guid",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));

elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'lessons',
	'container_guid' => $group->getGUID(),
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
	'no_results' => elgg_echo('lessons:none'),
);
$content = elgg_list_entities($options);
elgg_pop_context();
if($page_owner == elgg_get_logged_in_user_entity()->guid)
{
$new_link = elgg_view('output/url', array(
	'href' => "lessons/add/" . $group->getGUID(),
	'text' => elgg_echo('lessons:add:lessons'),
	'is_trusted' => true,
));
}



echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('lessons:group'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $new_link,
));