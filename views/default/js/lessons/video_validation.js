/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


define(function(require) {
    var elgg = require("elgg");
    var $ = require("jquery");

//console.log('9fdf');



$( "#lessons_video_url" ).keyup(function() {
    var p = document.getElementById('save');
    var notification = document.getElementById('url_notification');
    var selection = document.getElementById("video_source").value;
    var url = $('#lessons_video_url').val();
        if (url != undefined || url != '') {
            var regExp = /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
            var regVimeo = /(http|https)?:\/\/(www\.|player\.)?vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|video\/|)(\d+)(?:|\/\?)/;
            
            if(url.match(regExp) && selection == '1'){
/*
            if(url.match(regExp)){
            document.getElementById("videolist_type").value = "1";
            }

            if(url.match(regVimeo)){
            document.getElementById("videolist_type").value = "2";
            } */
            
            //p.removeAttribute("hidden");
            notification.setAttribute("hidden", true)
            }
            else 
            if(url.match(regVimeo) && selection == '2'){
/*
            if(url.match(regExp)){
            document.getElementById("videolist_type").value = "1";
            }

            if(url.match(regVimeo)){
            document.getElementById("videolist_type").value = "2";
            } */
            
            //p.removeAttribute("hidden");
            notification.setAttribute("hidden", true)
            }
            else{
                
            notification.removeAttribute("hidden");

//            p.setAttribute("hidden", true)
           // document.getElementById("videolist_type").value = "";
            }
            
            
            }
            
            

});

$("#video_source").on("change", function() {
    var p = document.getElementById('test');
    var selection = document.getElementById("video_source").value;
    var notification = document.getElementById('url_notification');
    document.getElementById("lessons_video_url").value = "";
    notification.setAttribute("hidden", true)
     if(selection == '1' || selection == '2')
         {
          //console.log('asdjshfjahsdjjadsf');
          p.removeAttribute("hidden");
          $("#lessons_video_url").attr("required", true);

         }
         else{
             p.setAttribute("hidden", true)
             $('#lessons_video_url').removeAttr('required');
             
         }
         
         if(selection == '0')
         {
             document.getElementById("lessons_video_url").value = "";
            //$("#lessons_video_url").value = '';
             notification.setAttribute("hidden", true)
         }
  //  p.removeAttribute("hidden");
    
    
    
    //$("form").hide();
    //$("#" + $(this).val()).show();
})



   
});