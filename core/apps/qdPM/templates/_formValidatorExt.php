<script type="text/javascript">
$(document).ready(function(){  
  $.extend($.validator.messages, {required: '<?php echo __("This field is required!") ?>'});
  
  $("#<?php echo $form_id ?>").validate({invalidHandler: function(e, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				var message = '<?php echo __("Some fields are required. They have been highlighted above.") ?>';
				$("div.error span").html(message);
				$("div.error").show();				
			} 
		}});
}); 		
</script>

<div class="error"><span></span></div>