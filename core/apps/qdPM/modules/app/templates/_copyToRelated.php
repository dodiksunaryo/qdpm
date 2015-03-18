<?php if($is_related): ?>
<fieldset style="margin-bottom: 5px;">
  <legend><?php echo __($title)?></legend>
  <?php      
    echo '<a href="#" onClick="copyToRelated(\'' . $form_name . '\',\'name\')">' . __('Name') . '</a> | <a href="#" onClick="copyToRelated(\'' . $form_name . '\',\'description\')">' . __('Description') . '</a> | <a id="copy_attachments_link" href="#" onClick="copyToRelated(\'' . $form_name . '\',\'attachments\',\'' . url_for('app/copyAttachments?to=' . $form_name) . '\',\'' . url_for('attachments/preview?bind_type=' . $form_name . '&bind_id=0') . '\')">' . __('Attachments') . '</a>';
  ?>
</fieldset>
<?php endif ?>

<script>
  
  if(!document.getElementById('item_attachments'))
  {
    $('#copy_attachments_link').css('display','none');
  }
</script>