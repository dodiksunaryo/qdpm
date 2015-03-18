<h1><?php echo __('Features') ?></h1>

<table class="contentTable">
  <tr>
    <th><label for="cfg_app_use_skins"><?php echo __('Use Skins'); ?></label></th>
    <td><?php echo select_tag('cfg[app_use_skins]',sfConfig::get('app_use_skins'),array('choices'=>$default_selector)); ?></td>
  </tr>  
  <tr>
    <th><label for="cfg_app_use_project_phases"><?php echo __('Use Project Phases'); ?></label></th>
    <td><?php echo select_tag('cfg[app_use_project_phases]',sfConfig::get('app_use_project_phases'),array('choices'=>$default_selector)) ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_use_project_versions"><?php echo __('Use Project Versions'); ?></label></th>
    <td><?php echo select_tag('cfg[app_use_project_versions]',sfConfig::get('app_use_project_versions'),array('choices'=>$default_selector)) ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_use_tasks_groups"><?php echo __('Use Tasks Groups'); ?></label></th>
    <td><?php echo select_tag('cfg[app_use_tasks_groups]',sfConfig::get('app_use_tasks_groups'),array('choices'=>$default_selector)) ?></td>
  </tr>
  
  <tr>
    <th><label for="cfg_app_use_javascript_dropdown"><?php echo __('Use Javascript Dropdown'); ?></label></th>
    <td><?php echo select_tag('cfg[app_use_javascript_dropdown]',sfConfig::get('app_use_javascript_dropdown'),array('choices'=>$default_selector)) ?></td>
  </tr>
  <tr>
    <th><label for="cfg_app_allow_adit_tasks_comments_date"><?php echo __('Allow edit tasks comments date'); ?></label></th>
    <td><?php echo select_tag('cfg[app_allow_adit_tasks_comments_date]',sfConfig::get('app_allow_adit_tasks_comments_date'), array('choices'=>$default_selector)); ?></td>
  </tr>  

</table>
   