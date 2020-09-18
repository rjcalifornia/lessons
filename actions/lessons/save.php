<?php
/**
 * Topic save action
 */

// Get variables
$title = htmlspecialchars(get_input('title', '', false), ENT_QUOTES, 'UTF-8');

$desc = get_input("description");
$duration = get_input("duration");
$videoSource = get_input("lessons_video_source");
$videoUrl = get_input("video_url");



$status = get_input("status");
$access_id = (int) get_input("access_id");
$container_guid = (int) get_input('container_guid');
$guid = (int) get_input('topic_guid');
$tags = get_input("tags");

elgg_make_sticky_form('lessons');

// validation of inputs
if (!$title || !$desc) {
	register_error(elgg_echo('discussion:error:missing'));
	forward(REFERER);
}

$container = get_entity($container_guid);


// check whether this is a new topic or an edit
$new_topic = true;
if ($guid > 0) {
	$new_topic = false;
}

if ($new_topic) {
	$topic = new ElggLessons();
	$topic->subtype = 'lessons';
} else {
	// load original file object
	$topic = get_entity($guid);
	if (!elgg_instanceof($topic, 'object', 'lessons') || !$topic->canEdit()) {
		register_error(elgg_echo('lessons:topic:notfound'));
		forward(REFERER);
	}
}

$topic->title = $title;
$topic->description = $desc;
$topic->duration = $duration;
$topic->owner_guid = elgg_get_logged_in_user_guid();
$topic->container_guid = (int)get_input('container_guid');

if($videoSource != 0){
$topic->video_source = $videoSource;
$topic->video_url = $videoUrl;
}


$featuredImage = elgg_get_uploaded_files('lessons_image');
if ($featuredImage) {
$uploaded_file = array_shift($featuredImage);
if (!$uploaded_file->isValid()) {
        $error = elgg_get_friendly_upload_error($uploaded_file->getError());
        register_error($error);
        forward(REFERER);
}
}


$readingMaterial = elgg_get_uploaded_files('lessons_reading_material');
if ($readingMaterial) {
$uploaded_material = array_shift($readingMaterial);
if (!$uploaded_material->isValid()) {
        $error = elgg_get_friendly_upload_error($uploaded_material->getError());
        register_error($error);
        forward(REFERER);
}
}




$topic->status = $status;
$topic->access_id = $access_id;
//$topic->container_guid = $container_guid;

$topic->tags = string_to_tag_array($tags);

$result = $topic->save();

if (!$result) {
	register_error(elgg_echo('lessons:error:notsaved'));
	forward(REFERER);
}


if($uploaded_file)  
{
$file = new LessonsFeatured();
$file->title = $file->getFilename();
//$file->subtype = "attachments";
//$file->category = "featured";
$file->container_guid = $topic->getGUID();
$file->access_id = 2;
//$file->thumbnail = $file->getIcon('small')->getFilename();
//$file->smallthumb = $file->getIcon('medium')->getFilename();
//$file->largethumb = $file->getIcon('large')->getFilename();
if ($file->acceptUploadedFile($uploaded_file)) {
        //$guid = $file->save(); 
        $file->save();
        
          
}
        }
        
if($uploaded_material)  
{
$fileAttachment = new ReadingMaterial();
$fileAttachment->title = $fileAttachment->getFilename();

$fileAttachment->container_guid = $topic->getGUID();
$fileAttachment->access_id = 2;


if ($fileAttachment->acceptUploadedFile($uploaded_material)) {
        $fileAttachment->save();
        
          
}
        }


// topic saved so clear sticky form
elgg_clear_sticky_form('lessons');


// handle results differently for new topics and topic edits
if ($new_topic) {
	system_message(elgg_echo('lessons:topic:created'));

	elgg_create_river_item(array(
		'view' => 'river/object/lessons/create',
		'action_type' => 'create',
		'subject_guid' => elgg_get_logged_in_user_guid(),
		'object_guid' => $topic->guid,
		'target_guid' => $container_guid,
	));
} else {
	system_message(elgg_echo('lessons:topic:updated'));
}

forward($topic->getURL());
