<?php
/**
 * Save a discussion reply
 */
$ia = elgg_set_ignore_access(true);
elgg_set_ignore_access(true);
// Get input
$topic_guid = (int) get_input('lesson_guid');
$student = elgg_get_logged_in_user_entity();
$text = $student->name;
//$reply_guid = (int) get_input('guid');

$topic = get_entity($topic_guid);


$user = elgg_get_logged_in_user_entity();

	$completeLesson = new ElggLessonsCompleted;
	$completeLesson->description = $text;
	$completeLesson->access_id = 2;
	$completeLesson->container_guid = $topic->getGUID();
	$completeLesson->owner_guid = $user->getGUID();

	$result = $completeLesson->save();
 
	system_message(elgg_echo('lesson:complete:success'));



forward($topic->getURL());
