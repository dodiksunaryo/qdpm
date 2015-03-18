<h1><?php echo __('Configure Email notification for new user') ?></h1>


<table class="contentTable">
  <tr>
    <th><label for="cfg_app_new_user_email_subject"><?php echo __('Subject'); ?></label></th>
    <td><?php echo input_tag('cfg[app_new_user_email_subject]', sfConfig::get('app_new_user_email_subject'),array('size'=>'60')); ?>
    <br>
    <?php echo  '<b>' . __('Default') . ':</b> ' . __('Your account has been created in') . ' ' . sfConfig::get('app_app_name')?>
    </td>
  </tr>
  <tr>
    <th><label for="cfg_app_new_user_email_body"><?php echo __('Body'); ?></label></th>
    <td><?php echo textarea_tag('cfg[app_new_user_email_body]', sfConfig::get('app_new_user_email_body'),array('class'=>'editor')); ?>    
    <?php echo  '<b>' . __('Note') . ':</b> ' . __('by default login details will be added at the end message')?>
    <table>
      <tr>
        <td><?php echo __('Use Keys') ?>:</td>
        <td>
          [user_name] - <?php echo __('to include User Name') ?><br> 
          [login_details] - <?php echo __('to include Login Details') ?><br>
        </td>
      </tr>
    </table>    
    </td>
  </tr>
</table>

<script type="text/javascript">    
  $(function() {     
    $( "textarea.editor" ).each(function() { addEditorToTextarea($(this).attr('id')) });               
  });
</script> 
