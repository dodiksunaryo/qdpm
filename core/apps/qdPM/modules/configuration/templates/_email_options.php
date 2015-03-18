<h1><?php echo __('Email Options') ?></h1>

<b><?php echo __('Notifications'); ?></b>
<table class="contentTable">
  <tr>
    <th><label for="cfg_app_use_email_notification"><?php echo __('Use email notification'); ?></label></th>
    <td><?php echo select_tag('cfg[app_use_email_notification]',sfConfig::get('app_use_email_notification'), array('choices'=>$default_selector)); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_email_label"><?php echo __('Email Subject Label'); ?></label></th>
    <td><?php echo input_tag('cfg[app_email_label]', sfConfig::get('app_email_label'),array('size'=>'40')); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_notify_all_customers"><?php echo __('Amount previous comments in email'); ?></label></th>
    <td><?php echo input_tag('cfg[app_amount_previous_comments]',sfConfig::get('app_amount_previous_comments',2), array('size'=>3)); ?></td>
  </tr>
  <tr>    
    <th><label for="cfg_app_use_email_notification"><?php echo __('Copy Sender?'); ?></label></th>
    <td><?php echo select_tag('cfg[app_send_email_to_owner]',sfConfig::get('app_send_email_to_owner'), array('choices'=> $default_selector)); ?></td>
  </tr>      
</table>  
<br>
<table class="contentTable">
  <tr>
    <th><label for="cfg_app_use_single_email"><?php echo __('Send all emails from single email address'); ?></label></th>
    <td><?php echo select_tag('cfg[app_use_single_email]',sfConfig::get('app_use_single_email'), array('choices'=>$default_selector)); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_single_email_addres_from"><?php echo __('Email address from'); ?></label></th>
    <td><?php echo input_tag('cfg[app_single_email_addres_from]', sfConfig::get('app_single_email_addres_from'),array('size'=>40)); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_single_name_from"><?php echo __('Name from'); ?></label></th>
    <td><?php echo input_tag('cfg[app_single_name_from]', sfConfig::get('app_single_name_from'),array('size'=>40)); ?></td>
  </tr>
</table>  
<br>
<b><?php echo __('SMTP Configuration'); ?></b>
<table class="contentTable">
  <tr>
    <th><label for="cfg_app_use_smtp"><?php echo __('Use SMTP'); ?></label></th>
    <td><?php echo select_tag('cfg[app_use_smtp]',sfConfig::get('app_use_smtp'),array('choices'=>$default_selector)); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_smtp_server"><?php echo __('SMTP Server'); ?></label></th>
    <td><?php echo input_tag('cfg[app_smtp_server]', sfConfig::get('app_smtp_server'),array('size'=>40)); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_smtp_port"><?php echo __('SMTP Port'); ?></label></th>
    <td><?php echo input_tag('cfg[app_smtp_port]', sfConfig::get('app_smtp_port'),array('size'=>5)); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_smtp_encryption"><?php echo __('SMTP Encryption'); ?></label></th>
    <td><?php echo input_tag('cfg[app_smtp_encryption]', sfConfig::get('app_smtp_encryption'),array('size'=>5)) . ' ' . implode('/',stream_get_transports()); ?></td>
  </tr>  
  <tr>
    <th><label for="cfg_app_smtp_login"><?php echo __('SMTP Login'); ?></label></th>
    <td><?php echo input_tag('cfg[app_smtp_login]', sfConfig::get('app_smtp_login'),array('size'=>40)); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_smtp_pass"><?php echo __('SMTP Password'); ?></label></th>
    <td><?php echo input_tag('cfg[app_smtp_pass]', sfConfig::get('app_smtp_pass'),array('size'=>40)); ?></td>
  </tr>

</table>  