
<div id="attachmentsList"></div>

<div> <input type="file" name="uploadify_file_upload" id="uploadify_file_upload" /> </div>

<script>
var is_file_uploading = null;
$(function() {
        
    $("#uploadify_file_upload").uploadify({
        debug         : false,
        buttonText    : '+ <?php echo __("Add Attachments")?>',
        removeTimeout : 0,                        
        height: '21',    
        width: '220',
        cancelImg: '<?php echo public_path("js/uploadify/uploadify-cancel.png",true) ?>',
        onUploadStart : function(file) { is_file_uploading = true },
        onQueueComplete : function(queueData) {is_file_uploading = null },        
        fileSizeLimit : '<?php echo ((int)ini_get("post_max_size")<(int)ini_get("upload_max_filesize") ? (int)ini_get("post_max_size") : (int)ini_get("upload_max_filesize"))?>MB',            
        swf           : '<?php echo public_path("js/uploadify/uploadify.swf",true) ?>',
        uploader      : '<?php echo url_for("attachments/upload?bind_type=" . $bind_type . "&bind_id=" . $bind_id . "&uploadify=onUpload&" . session_name() . "=" . session_id(), true)?>',            
        onUploadComplete : function(file) {
        
          $.ajax({
            type: 'POST',
            url: "<?php echo  url_for('attachments/saveInfo') ?>",
            data: $('.attachments_textarea').serializeArray(),
            success: function(data) {
              $("#attachmentsList").load("<?php echo  url_for('attachments/preview?bind_type=' . $bind_type . '&bind_id=' . $bind_id ) ?>");
            }
          });
              
        }            
    });
    
    $("#attachmentsList").load("<?php echo  url_for('attachments/preview?bind_type=' . $bind_type . '&bind_id=' . $bind_id ) ?>");
    
    $('input[type=submit]').bind('click',function(){ 
                  
      if(is_file_uploading)
      {
        alert('<?php echo __("Please wait. Files are loading.") ?>'); return false;
      }         
            
    });            
});

</script>

