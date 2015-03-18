<h1><?php echo __('General Configuration') ?></h1>

<b><?php echo __('Root Administrator'); ?></b>

<table class="contentTable">
  <tr>
    <th><label for="cfg_app_administrator_email"><?php echo __('Administrator Email'); ?></label></th>
    <td><?php echo input_tag('cfg[app_administrator_email]', sfConfig::get('app_administrator_email'),array('size'=>'40')); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_administrator_password"><?php echo __('Administrator Password'); ?></label></th>
    <td><?php echo input_tag('cfg[app_administrator_password]', sfConfig::get('app_administrator_password'),array('size'=>'40')); ?></td>
  </tr>
</table>
<i>&nbsp;&nbsp;<?php echo __('Root administrator is internal user who can just manage users and configuration and can’t create tasks or projects');?></i>  
<br><br>
<b><?php echo __('Application'); ?></b>
<table class="contentTable">
  <tr>
    <th><label for="cfg_app_app_name"><?php echo __('Name of application'); ?></label></th>
    <td><?php echo input_tag('cfg[app_app_name]', sfConfig::get('app_app_name'),array('size'=>'40')); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_app_short_name"><?php echo __('Short name of application'); ?></label></th>
    <td><?php echo input_tag('cfg[app_app_short_name]', sfConfig::get('app_app_short_name'),array('size'=>'40')); ?></td>
  </tr>  
  <tr>
    <th><label for="cfg_app_app_logo_file"><?php echo __('Logo'); ?></label></th>
    <td><?php echo input_file_tag('cfg_app_app_logo_file') . input_hidden_tag('cfg[app_app_logo]', sfConfig::get('app_app_logo'),array('size'=>'40')) ; 
      if(is_file(sfConfig::get('sf_upload_dir')  . '/' . sfConfig::get('app_app_logo')))
      {
        echo '<div>' . sfConfig::get('app_app_logo') . '</div>' . input_checkbox_tag('delete_logo') . ' <label for="delete_logo">' . __('Delete') . '</label>';
      }  
      
      echo '<div><i>' . __('Note: logo might be not looks OK in all skins so you should pick one skin or create your own skin.') . '</i></div>'                                                                                   
    ?></td>
  </tr>
  
</table> 
<br>

<?php

  $skins_list = array();
  
  $skinsDir = sfConfig::get('sf_web_dir') . '/css/skins/';
  
  if ($handle = opendir($skinsDir)) 
  {             
    while (false !== ($file = readdir($handle))) 
    {
      if ($file != "." && $file != ".." && is_dir($skinsDir . $file)) 
      {                     
        $skins_list[$file] = $file;
      }  
    }  
  }


  $timezone_list = array();
  $timezone_identifiers = DateTimeZone::listIdentifiers();
  for ($i=0; $i < sizeof($timezone_identifiers); $i++) 
  {    
      $timezone_list[$timezone_identifiers[$i]] = $timezone_identifiers[$i];
  }

  
?>

<b><?php echo __('Defaults'); ?></b>
<table class="contentTable">
  <tr>
    <th><label for="cfg_app_default_skin"><?php echo __('Default Skin'); ?></label></th>
    <td><?php echo select_tag('cfg[app_default_skin]',sfConfig::get('app_default_skin'), array('choices'=>$skins_list)); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_sf_default_timezone"><?php echo __('Default Timezone'); ?></label></th>
    <td><?php echo select_tag('cfg[sf_default_timezone]',sfConfig::get('sf_default_timezone'), array('choices'=>$timezone_list)); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_sf_default_culture"><?php echo __('Default Culture'); ?></label></th>
    <td><?php echo languages_select_tag('cfg[sf_default_culture]', sfConfig::get('sf_default_culture')); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_rows_per_page"><?php echo __('Default Rows Per Page'); ?></label></th>
    <td><?php echo input_tag('cfg[app_rows_per_page]', sfConfig::get('app_rows_per_page'),array('size'=>'5')); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_rows_per_page"><?php echo __('Rows Limit'); ?></label></th>
    <td><?php echo input_tag('cfg[app_rows_limit]', sfConfig::get('app_rows_limit',1000),array('size'=>'3')); ?><br>
      <i><?php echo __('This option allows you to limit the number of rows retrieved in a single database query.<br>You can use this option if your server has problems displaying a lot of data.<br>Once you set this option, the query results will be displayed in paged format and you will see the extra PHP pager at the bottom of the page that will allow you to fetch more.') ?></i>
    </td>
  </tr>
  <tr>
    <th><label for="cfg_app_custom_short_date_format"><?php echo __('Default Date Format'); ?></label></th>
    <td><?php echo input_tag('cfg[app_custom_short_date_format]', sfConfig::get('app_custom_short_date_format'),array('size'=>'5')); ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_custom_logn_date_format"><?php echo __('Default Comments Date Format'); ?></label></th>
    <td><?php echo input_tag('cfg[app_custom_logn_date_format]', sfConfig::get('app_custom_logn_date_format'),array('size'=>'5')); ?></td>
  </tr>
</table> 
<i>&nbsp;&nbsp;<?php echo __('more about date format see') . ' ' .  link_to('format a local time/date','http://php.net/manual/en/function.date.php',array('target'=>'_blanck'));?></i>   
<br><br>
  