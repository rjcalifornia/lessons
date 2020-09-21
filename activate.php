<?php
/**
 * Register the ElggDiscussionReply class for the object/discussion_reply subtype
 */

if (get_subtype_id('object', 'lessons_reply')) {
	update_subtype('object', 'lessons_reply', 'ElggLessonsReply');
} else {
	add_subtype('object', 'lessons_reply', 'ElggLessonsReply');
}

if (get_subtype_id('object', 'lessons_completed')) {
	update_subtype('object', 'lessons_completed', 'ElggLessonsCompleted');
} else {
	add_subtype('object', 'lessons_completed', 'ElggLessonsCompleted');
}

if (get_subtype_id('object', 'lessons_featured')) {
	update_subtype('object', 'lessons_featured', 'LessonsFeatured');
} else {
	add_subtype('object', 'lessons_featured', 'LessonsFeatured');
}
if (get_subtype_id('object', 'reading_material')) {
	update_subtype('object', 'reading_material', 'ReadingMaterial');
} else {
	add_subtype('object', 'reading_material', 'ReadingMaterial');
}


