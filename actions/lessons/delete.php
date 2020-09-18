<?php
/**
 * Delete topic action
 */

$topic_guid = (int) get_input('guid');

$topic = get_entity($topic_guid);
if (!elgg_instanceof($topic, 'object', 'lessons')) {
	register_error(elgg_echo('lessons:error:notdeleted'));
	forward(REFERER);
}

if (!$topic->canEdit()) {
	register_error(elgg_echo('lessons:error:permissions'));
	forward(REFERER);
}

$container = $topic->getContainerEntity();

$result = $topic->delete();
if ($result) {
	system_message(elgg_echo('lessons:topic:deleted'));
} else {
	register_error(elgg_echo('lessons:error:notdeleted'));
}

forward("lessons/owner/$container->guid");
