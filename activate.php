<?php
/**
 * Register the ElggDiscussionReply class for the object/discussion_reply subtype
 */

if (get_subtype_id('object', 'lessons_reply')) {
	update_subtype('object', 'lessons_reply', 'ElggLessonsReply');
} else {
	add_subtype('object', 'lessons_reply', 'ElggLessonsReply');
}
