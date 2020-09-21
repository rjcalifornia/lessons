<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$lesson = $vars['entity'];

$group_guid = $lesson->container_guid;

$group = get_entity($group_guid);



$featured = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'lessons_featured',
        //'category' => 'featured',
        'container_guid' => $lesson->guid,
	//'full_view' => false,
        'limit' => 1,
	'no_results' => elgg_echo("file:none"),
	'preload_owners' => true,
	'preload_containers' => true,
	'distinct' => false,
));



$readingMaterial = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'reading_material',
        
        'container_guid' => $lesson->guid,
	
        'limit' => 1,
	'no_results' => elgg_echo("file:none"),
	'preload_owners' => true,
	'preload_containers' => true,
	'distinct' => false,
));
//var_dump($readingMaterial);
?>


  <div class="col-md-12">
      <p>
          <a href="<?php echo $group->getURL();?>"> 
      <h4><span class="fa fa-users"></span> <?php echo $group->name;?></h4>
      </a>
      </p>
      <?php
              
        foreach ($featured as $f) {
                 $file = get_entity($f->guid);
               //  echo $file->title;
                 
                 $downloadUrl = elgg_get_download_url($file);
                 
                 
              ?>
          
          
          <img src="<?php echo $downloadUrl; ?>" width="100%"/>
          <?php
        }
          ?>
      </div>
  <div class="col-md-12" style="padding:20px; margin-top: 18px;">



     
          <h1 class="lesson-title"> 
              
    <?php
        echo $lesson->title;
        
    ?>
     
</h1>
          <h6 class="lesson-breads"> 
       <span class="fa fa-clock-o"></span>       
    <?php echo elgg_echo('lesson:estimated_duration'); ?>: 
    <?php echo $lesson->duration; ?>
     
</h6>
      
      
      <div class="lesson-content">
          <p>
              <?php
                echo $lesson->description;
              ?>
          </p>
          </div>
      
      <?php 
      
      if($lesson->video_url != null){
          
          ?>
      <div class="lesson-url">
          
<h3 class="lesson-resources"> 
<span class="fa fa-youtube-play"></span>
    <?php
        echo elgg_echo('lesson:video:resources');
    ?>
     
</h3>
          <p>
              <?php
              
    if($lesson->video_source == '1')
    {
              //  echo $lesson->video_url;
                ?>
              <center>
<video
    id="vid1"
    class="video-js vjs-default-skin"
    controls
    
    
    data-setup='{ "fluid": true,"techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "<?php echo $lesson->video_url;?>"}] }'
  >
  </video>
  </center>
              <?php
    }
    
    
    if($lesson->video_source == '2')
    {
        
        //echo $videolist->video_url;
        $content = file_get_contents("https://vimeo.com/api/oembed.json?url=" . $lesson->video_url . '&width=720&height=480');
        ///parse_str($content, $ytarr);
        $jsondec = json_decode($content);
        
        ?>
          <center>
        <?php echo $jsondec->html; ?>
        </center>
          <?php
 

  
    }
                ?>
              </p>
      </div>
      <?php 
      
      }
      
      ?>
      
      <?php 
      
      if($readingMaterial != null)
      {
      ?>
      
       <p>         
<h3 class="lesson-reading-material"> 
<span class="fa fa-book"></span>
    <?php
        echo elgg_echo('lesson:reading_material:resources');
    ?>
     
</h3>
       </p>
      
      <div class="reading_material">
      <?php 
      
      
      
      ?>
          <?php
              
        foreach ($readingMaterial as $r) {
                 $lessonReadingMaterial = get_entity($r->guid);
               //  echo $file->title;
                 
                 $readingMaterialDownloadUrl = elgg_get_download_url($lessonReadingMaterial);
                 
                 
              ?>
          
          
          
          <a href="<?php echo $readingMaterialDownloadUrl; ?>" class="elgg-menu-content elgg-button elgg-button-action extras-reading">
              <span class="fa fa-arrow-circle-down"></span> 
              <?php echo $lessonReadingMaterial->title; ?>
          </a>
          <?php
        }
          ?>
      </div>
      
      <?php 
      
      }
      
      ?>
      </div>