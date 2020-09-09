/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


define(function(require) {
    var elgg = require("elgg");
    var $ = require("jquery");

//console.log('9fdf');



$( "#videolist_url" ).keyup(function() {
    var p = document.getElementById('share');
    var url = $('#videolist_url').val();
        if (url != undefined || url != '') {
            var regExp = /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
            var regVimeo = /(http|https)?:\/\/(www\.|player\.)?vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|video\/|)(\d+)(?:|\/\?)/;
            
            if(url.match(regExp) || url.match(regVimeo)){

            if(url.match(regExp)){
            document.getElementById("videolist_type").value = "1";
            }

            if(url.match(regVimeo)){
            document.getElementById("videolist_type").value = "2";
            }
            p.removeAttribute("hidden");
            }
            else{

            p.setAttribute("hidden", true)
            document.getElementById("videolist_type").value = "";
            }
            }

});

$("#video_source").on("change", function() {
    var p = document.getElementById('test');
    var selection = document.getElementById("video_source").value;
    
     if(selection == '1' || selection == '2')
         {
          console.log('asdjshfjahsdjjadsf');
          p.removeAttribute("hidden");
          $("#lessons_video_url").attr("required", true);

         }
         else{
             p.setAttribute("hidden", true)
             $('#lessons_video_url').removeAttr('required');
             
         }
  //  p.removeAttribute("hidden");
    
    
    
    //$("form").hide();
    //$("#" + $(this).val()).show();
})



   
});