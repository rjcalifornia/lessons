<?php

/**
 * Discussion topic add/edit form body
 *
 */

$lesson = get_entity($vars['guid']);
$vars['entity'] = $lesson;
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$guid = $lesson->guid;
$action_buttons = '';
$delete_link = '';


if ($vars['guid']) {
	// add a delete button if editing
	$delete_url = "action/lessons/delete?guid={$vars['guid']}";
	$delete_link = elgg_view('output/url', array(
		'href' => $delete_url,
		'text' => elgg_echo('delete'),
		'class' => 'elgg-button elgg-button-delete float-alt',
		'confirm' => true,
	));
}


$titleLabel = elgg_echo('lessons:title');
$titleInput = elgg_view('input/text', array(
	'name' => 'title',
	'id' => 'lessons_title',
	'value' => $vars['title'],
        'required' => true,
));

$contentLabel = elgg_echo('lessons:content');
$contentInput = elgg_view('input/longtext', array(
	'name' => 'description',
	'id' => 'lessons_description',
	'value' => $vars['description'],
        'required' => true,
));


$imageLabel = elgg_echo('lessons:featured_image');
$imageInput = elgg_view('input/file', array(
	'id' => 'lessons_image',
	'name' => 'featured_image',
        'label' => 'Select an image to upload',
        'help' => 'Only jpeg, gif and png images are supported',
        'required' => false,
));



$durationLabel = elgg_echo('lessons:estimated_duration');
$durationInput = elgg_view('input/text', array(
	'name' => 'duration',
	'id' => 'lessons_duration',
	'value' => $vars['duration'],
        'required' => true,
));

$sourceLabel = elgg_echo('lessons:video_source');
$sourceInput = elgg_view('input/select', array(
    'name' => 'lessons_video_source',
    'options_values' => array(
                
		'1' => 'YouTube',
                '2' => 'Vimeo',
        )
)
        );


$accessLabel = elgg_echo('access');
$accessInput = elgg_view(
'input/access',array(
		'name' => 'access_id',
		'value' => $access_id,
		'entity' => get_entity($guid),
		'entity_type' => 'object',
		'entity_subtype' => 'lessons',
		'label' => elgg_echo('access'),
));


echo <<<___HTML

<div>
	<label for="title">$titleLabel</label>
	$titleInput
</div>


<div>
	<label for="content">$contentLabel</label>
	$contentInput
</div>
        
        
<div>
	<label for="file">$imageLabel</label>
	$imageInput
</div>
        
             
<div>
	<label for="duration">$durationLabel</label>
	$durationInput
</div>

<div>
	<label for="resource">Resources (Optional)</label>
	
</div>
<div>
	<label for="source">$sourceLabel</label>
	$sourceInput
</div>
        
<div>
	<label for="access">$accssLabel</label>
	$accessInput
</div>
        
___HTML;

$footer = <<<___HTML

$action_buttons
___HTML;

elgg_set_form_footer($footer);
/*
$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$featuredImage = elgg_extract('featured_image', $vars, '');
$estimatedDuration = elgg_extract('estimated_duration', $vars, '');
$videoUrl = elgg_extract('video_url', $vars, '');
$readingMaterial = elgg_extract('reading_material', $vars, '');
$status = elgg_extract('status', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
$guid = elgg_extract('guid', $vars, null);

$fields = [
	[
		'#type' => 'text',
		'name' => 'title',
		'value' => $title,
		'#label' => elgg_echo('title'),
		'required' => true,
	],
	[
		'#type' => 'longtext',
		'name' => 'description',
		'value' => $desc,
		'#label' => elgg_echo('discussion:topic:description'),
		'required' => true,
	],
	[
		'#type' => 'tags',
		'name' => 'tags',
		'value' => $tags,
		'#label' => elgg_echo('tags'),
	],
	[
		'#type' => 'select',
		'name' => 'status',
		'value' => $status,
		'options_values' => array(
			'open' => elgg_echo('status:open'),
			'closed' => elgg_echo('status:closed'),
		),
		'#label' => elgg_echo('discussion:topic:status'),
	],
	[
		'#type' => 'access',
		'name' => 'access_id',
		'value' => $access_id,
		'entity' => get_entity($guid),
		'entity_type' => 'object',
		'entity_subtype' => 'discussion',
		'#label' => elgg_echo('access'),
	],
	[
		'#type' => 'hidden',
		'name' => 'container_guid',
		'value' => $container_guid,
	],
	[
		'#type' => 'hidden',
		'name' => 'topic_guid',
		'value' => $guid,
	],
];

foreach ($fields as $field) {
	echo elgg_view_field($field);
}

$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('save'),
]);
elgg_set_form_footer($footer);*/