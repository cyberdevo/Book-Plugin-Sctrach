jQuery(document).ready(function() {
    jQuery('#mybook').DataTable();
    jQuery("#btnUpload").on("click",function(){
        
       var image=wp.media({
           title:"Upload Image For My Book",
           multiple:false
       }).open().on("select",function(){
           var upload_image=image.state().get("selection").first();
           var getImage=upload_image.toJSON().url;
       
           jQuery("#show-image").html("<img src='"+getImage+"' style='height:50px;width:50px;'>");
           jQuery("#image-name").val(getImage);
       })
    })
    
        jQuery(document).on("click",".btndelete",function(){
            var conf=confirm("Are You Sure to delete the record");
            if(conf){
            var book_id=jQuery(this).attr("data-id")
            var postdata="action=mybooklibrary&param=delete_book&id="+book_id;
                   jQuery.post(mybookajaxurl,postdata,function(response){
                      var data=jQuery.parseJSON(response);
                      if(data.status==1){
                          jQuery.notifyBar({
                              cssClass:"success",
                              html:data.message
                          })
                          setTimeout(function(){
                              location.reload()
                          },1300)
                      }
                   });
                }
           })
    
 
   
    jQuery("#frmAddBook").validate({
        submitHandler:function(){
           var postdata="action=mybooklibrary&param=save_book&"+jQuery("#frmAddBook").serialize() ;
           jQuery.post(mybookajaxurl,postdata,function(response){
              var data=jQuery.parseJSON(response);
              if(data.status==1){
                  jQuery.notifyBar({
                      cssClass:"success",
                      html:data.message
                  })
              }
           });
           
        }

    })
    
    
   
    jQuery("#frmEditBook").validate({
        submitHandler:function(){
            var postdata="action=mybooklibrary&param=edit_book&"+jQuery("#frmEditBook").serialize() ;
            jQuery.post(mybookajaxurl,postdata,function(response){
               var data=jQuery.parseJSON(response);
               if(data.status==1){
                   jQuery.notifyBar({
                       cssClass:"success",
                       html:data.message
                   });
                   setTimeout(function(){
                       location.reload()
                   },1300)
               }
            }); 
        }
    })
} );
